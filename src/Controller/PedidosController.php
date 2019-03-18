<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\CupomSite;
use App\Model\Entity\Endereco;
use App\Model\Entity\FormasPagamento;
use App\Model\Entity\ItensCarrinho;
use App\Model\Entity\Lista;
use App\Model\Entity\OpcoesExtra;
use App\Model\Entity\Pedido;
use App\Model\Entity\PedidosEntrega;
use App\Model\Entity\PedidosProduto;
use App\Model\Entity\TaxasEntregasCotacao;
use App\Model\Entity\TemposMedio;
use App\Model\Table\PedidosProdutosTable;
use App\Model\Table\PedidosTable;
use App\Model\Utils\ValidaPedidoAbertoCliente;
use Aura\Intl\Exception;
use Cake\Database\Connection;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\TableLocator;

/**
 * Pedidos Controller
 *
 * @property \App\Model\Table\PedidosTable $Pedidos
 *
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PedidosController extends AppController
{
    /** @var  $pedidoSession Pedido*/
    protected $pedidoSession;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->pertmiteAction('generatePedido');
        $this->pertmiteAction('aplicarCupom');
        $this->pertmiteAction('calcularAcrescimo');
        $this->pertmiteAction('rejeitarPedidoAberto');
        $this->pertmiteAction('confirmarPedidoAberto');
        $this->validateActions();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'FormasPagamentos']
        ];
        $pedidos = $this->paginate($this->Pedidos->find()->where(
            ['tipo_pedido' => Pedido::TIPO_PEDIDO_DELIVERY,
            'status_pedido <> ' => Pedido::STATUS_AGUARDANDO_CONFIRMACAO_CLIENTE]
        ))->sortBy('id', SORT_DESC);

        $this->set(compact('pedidos'));
    }

    public function comandas()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $pedidos = $this->paginate($this->Pedidos->find()->where(['tipo_pedido' => Pedido::TIPO_PEDIDO_COMANDA]))->sortBy('id', SORT_DESC);

        $this->set(compact('pedidos'));
    }

    public function alterarSituacao($id = null){
        $pedido = $this->Pedidos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pedido = $this->Pedidos->patchEntity($pedido, $this->request->getData());
            if ($this->Pedidos->save($pedido)) {
                $this->Flash->success(__('Situação Alterada com sucesso.'));
                if($pedido->tipo_pedido == Pedido::TIPO_PEDIDO_DELIVERY){
                    return $this->redirect(['action' => 'index']);
                }
                return $this->redirect(['action' => 'comandas']);
            }
            $this->Flash->error(__('Não foi possível alterar a situação, tente novamente.'));
        }
        $this->set(compact('pedido'));
    }

    public function imprimir($id = null){
        $pedido = $this->Pedidos->get($id);
        $itensBar = [];
        $itensCozinha = [];
        $adicionais = [];
        $tableLocator = new TableLocator();
        $pedidosProdutos = $tableLocator->get('PedidosProdutos')->find()->where(['pedido_id'=>$pedido->id]);
        foreach ($pedidosProdutos as $item){
            $produto = $tableLocator->get('Produtos')->find()->where(['id'=>$item->produto_id])->first();
            $categoria = $tableLocator->get('CategoriasProdutos')->find()->where(['id'=>$produto->categorias_produto_id])->first();
            if($item->ambiente_producao_responsavel == PedidosProduto::RESPONSAVEL_COZINHA){
                $itensCozinha[$item->id]['categoria'] = $categoria->nome_categoria;
                $itensCozinha[$item->id]['produto'] = $produto->nome_produto;
                $itensCozinha[$item->id]['observacao'] = $item->observacao;
                $itensCozinha[$item->id]['id'] = $item->id;
            }else{
                $itensBar[$item->id]['categoria'] = $categoria->nome_categoria;
                $itensBar[$item->id]['produto'] = $produto->nome_produto;
                $itensBar[$item->id]['observacao'] = $item->observacao;
                $itensBar[$item->id]['id'] = $item->id;;
            }
            $adicionais[$item->id] = $this->getAdicionais($item);
        }
        $this->set(compact('pedido', 'itensBar', 'itensCozinha', 'adicionais'));
    }

    /**
     * Retorna um array contendo os adicionais de um item.
     * @uses Usado tanto na visualizacao de pedido, pedidoItem e impressao de pedido! CUIDADO COM MANUTENCAO
     */
    public function getAdicionais(PedidosProduto $pedidoProduto){
        $tableLocator = new TableLocator();
        $adicionais = [];
        $adicionaisItemAtual = json_decode($pedidoProduto->opcionais, true);
        if(count($adicionaisItemAtual) > 0){
            foreach ($adicionaisItemAtual as $idLista => $opcionais){
                /** @var $listaModel Lista*/
                $listaModel = $tableLocator->get('Listas')->find()->where(['id'=>$idLista])->first();
                foreach($opcionais as $opcional){
                    /** @var $opcionalModel OpcoesExtra*/
                    $opcionalModel = $tableLocator->get('OpcoesExtras')->find()->where(['id'=>$opcional])->first();
                    $opcaoAtual = [];
                    $opcaoAtual['lista'] = $listaModel->nome_lista;
                    $opcaoAtual['nomeAdicional'] = $opcionalModel->nome_adicional;
                    $opcaoAtual['descricaoAdicional'] = $opcionalModel->descricao_adicional;
                    $opcaoAtual['idAdicional'] = $opcionalModel->id;
                    $adicionais[] = $opcaoAtual;
                }

            }
        }
        return $adicionais;
    }

    public function confirmar($id = null)
    {
        $pedido = $this->Pedidos->get($id);
        $tableLocator = new TableLocator();
        /** @var $produtosTable PedidosProdutosTable*/
        $produtosTable = $tableLocator->get('PedidosProdutos');
        /** @var $produtosPedidos PedidosProduto*/
        $produtosPedidos = $produtosTable->find()->where(['pedido_id' => $pedido->id]);
        $produtosFinal = [];
        $adicionais = [];
        foreach ($produtosPedidos as $produtoPedido) {
            $produtosFinal[] = $produtoPedido;
            $adicionaisItem = json_decode($produtoPedido->opcionais, true);
            foreach ($adicionaisItem as $idLista => $lista){
                /** @var $listaModel Lista*/
                $listaModel = $tableLocator->get('Listas')->find()->where(['id' => $idLista])->first();
                //$adicionais[$produtoPedido->id][$listaModel->id] = $this->getAdicionais($produtoPedido);
                $adicionais[$produtoPedido->id][$listaModel->nome_lista] = [];
                $opcionais = [];
                foreach ($lista as $opcional){
                    /** @var $opcionalModel OpcoesExtra*/
                    $opcionalModel = $tableLocator->get('OpcoesExtras')->find()->where(['id' => $opcional])->first();
                    $opcionais[$opcionalModel->id]['nome'] = $opcionalModel->nome_adicional ;
                    $opcionais[$opcionalModel->id]['descricao'] = $opcionalModel->descricao_adicional;
                }
                $adicionais[$produtoPedido->id][$listaModel->nome_lista] = $opcionais;
            }
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $successStatus = false;
            $pedido->status_pedido = Pedido::STATUS_EM_PRODUCAO;
            if($this->Pedidos->save($pedido)){
                $successStatus = true;
            }
            $produtosTable->getConnection()->begin();
            $gravouTodosItens = true;
            foreach ($produtosFinal as $item){
                $data = $this->getRequest()->getData();
                $item->status = PedidosProduto::STATUS_EM_FILA_PRODUCAO;
                if(isset($data['item-'.$item->id.'-bar'])){
                    $item->ambiente_producao_responsavel = PedidosProduto::RESPONSAVEL_BAR;
                }else{
                    $item->ambiente_producao_responsavel = PedidosProduto::RESPONSAVEL_COZINHA;
                }
                if($produtosTable->save($item)){

                }else{
                    $gravouTodosItens = false;
                }
            }
            if($gravouTodosItens && $successStatus){
                $produtosTable->getConnection()->commit();
                $this->Flash->success(__('Pedido Confirmado Com Sucesso.'));
                return $this->redirect(['action' => 'index']);
            }else{
                $produtosTable->getConnection()->rollback();
                $this->Flash->error(__('Não foi possível destinar os produtosPedidos ao seu setor responsavel, tente novamente.'));
            }
        }
        $pedido->status_pedido = Pedido::STATUS_EM_SEPARACAO_PARA_PRODUCAO;
        $this->Pedidos->save($pedido);
        $this->set(compact('pedido', 'produtosFinal', 'adicionais'));
    }

    public function rejeitar($id = null)
    {
        $success = true;
        $tableLocator = new TableLocator();
        $pedido = $this->Pedidos->get($id);
        $pedido->status_pedido = Pedido::STATUS_REJEITADO;
        $this->Pedidos->getConnection()->begin();
        /** @var $produtosPedidoTable PedidosProdutosTable*/
        $produtosPedidoTable = $tableLocator->get('PedidosProdutos');
        $produtosPedido = $produtosPedidoTable->find()->where(['pedido_id' => $pedido->id]);
        $produtosPedidoTable->getConnection()->begin();
        /** @var $produto PedidosProduto*/
        foreach ($produtosPedido as $produto){
            $produto->status = PedidosProduto::STATUS_PEDIDO_REJEITADO;
            if(!$produtosPedidoTable->save($produto)){
                $success = false;
            };
        }
        if (!$this->Pedidos->save($pedido)) {
            $success = false;
        }
        if($success){
            $this->Flash->success(__('Pedido Rejeitado Com Sucesso.'));
            $produtosPedidoTable->getConnection()->commit();
            $this->Pedidos->getConnection()->commit();
            return $this->redirect(['action' => 'index']);
        }else{
            $produtosPedidoTable->getConnection()->rollback();
            $this->Pedidos->getConnection()->rollback();
            $this->Flash->error(__('Não foi possível rejeitar o pedido, tente novamente.'));
        }
    }

    public function generatePedido($endereco = null)
    {
        $success = false;
        $tableLocator = new TableLocator();
        try {
            //Cria um novo pedido
            $this->Pedidos->getConnection()->begin();
            $newPedido = $this->Pedidos->newEntity();
            $newPedido->user_id = $this->Auth->user('id');
            $newPedido->valor_total_cobrado = 0;
            $newPedido->status_pedido = Pedido::STATUS_AGUARDANDO_CONFIRMACAO_CLIENTE;
            $newPedido->data_pedido = new  \DateTime();
            $tempoMedido = $tableLocator->get('TemposMedios')->find()->where(['ativo' => true]);
            if ($tempoMedido->first()) {
                /** @var $tempoFinal TemposMedio */
                $tempoFinal = $tempoMedido->first();
            }
            $newPedido->tempo_producao_aproximado_minutos = $tempoFinal->tempo_medio_producao_minutos;
            $this->render(false);
            if ($this->Pedidos->save($newPedido)) {

            } else {
                throw new \Exception('Erro ao cadastrar pedido');
            }
            //Adiciona os itens que compoem este pedido
            $itensCarrinhoTable = $tableLocator->get('ItensCarrinhos');
            $pedidosProdutosTable = $tableLocator->get('PedidosProdutos');
            $itensCarrinho = $itensCarrinhoTable->find()->where(['user_id' => $this->Auth->user('id')]);
            $pedidosProdutosTable->getConnection()->begin();
            /** @var $item ItensCarrinho */
            $valorCobradoPedido = 0;
            $itensCarrinhoTable->getConnection()->begin();
            foreach ($itensCarrinho as $item) {
                /** @var $newItem PedidosProduto*/
                $newItem = $pedidosProdutosTable->newEntity();
                $newItem->pedido_id = $newPedido->id;
                $newItem->produto_id = $item->produto_id;
                $newItem->quantidade = $item->quantidades;
                $newItem->valor_total_cobrado = $item->valor_total_cobrado;
                $valorCobradoPedido = $valorCobradoPedido + $item->valor_total_cobrado;
                $newItem->observacao = $item->observacao;
                $newItem->opcionais = $item->opicionais;
                $newItem->ambiente_producao_responsavel = PedidosProduto::RESPONSAVEL_COZINHA;
                $newItem->status = PedidosProduto::STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO;
                if ($pedidosProdutosTable->save($newItem)) {

                } else {
                    throw new \Exception('Erro ao cadastrar item');
                }
                $itensCarrinhoTable->delete($item);
            }
            //Altera o valor final do pedido com base nos itens lidos.
            $newPedido->valor_total_cobrado = $valorCobradoPedido;
            if ($this->Pedidos->save($newPedido)) {

            } else {
                throw new \Exception('Erro ao cadastrar valor do pedido');
            }
            //Realiza cotacao de frete
            if ($endereco != 'retirar-no-local') {
                $enderecoClienteModel = $tableLocator->get('Enderecos')->find()->where(['id' => $endereco])->first();
                $ruaFinal = str_replace(' ', '%20', $enderecoClienteModel->rua);
                $numeroFinal = str_replace(' ', '%20', $enderecoClienteModel->numero);
                $bairroFinal = str_replace(' ', '%20', $enderecoClienteModel->bairro);
                $cidadeFinal = str_replace(' ', '%20', $enderecoClienteModel->cidade);
                $estadoFinal = str_replace(' ', '%20', $enderecoClienteModel->estado);
                $enderecoEmpresaModel = $tableLocator->get('Enderecos')->find()->where(['tipo_endereco' => Endereco::TIPO_ENDERECO_EMPRESA])->first();
                $ruaEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->rua);
                $numeroEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->numero);
                $bairroEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->bairro);
                $cidadeEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->cidade);
                $estadoEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->estado);
                $cotacao = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?&origins=Rua%20' . $ruaFinal . '%20' . $numeroFinal . ',%20' . $bairroFinal . ',%20' . $cidadeFinal . '-' . $estadoFinal . '&destinations=Rua%20' . $ruaEmpresaFinal . '%20' . $numeroEmpresaFinal . ',%20' . $bairroEmpresaFinal . ',%20' . $cidadeEmpresaFinal . '-' . $estadoEmpresaFinal . '&language=pt-BR&key=AIzaSyBOfZCfy02ny8dk3LMcXOWtFuiDpqX1Qdw');
                $cotacao = json_decode($cotacao, true);
                $cotacaoSuccess = false;
                $cotacaoKms = false;
                if (isset($cotacao['rows'])) {
                    if (isset($cotacao['rows']['0'])) {
                        if (isset($cotacao['rows']['0']['elements'])) {
                            if (isset($cotacao['rows']['0']['elements']['0'])) {
                                if (isset($cotacao['rows']['0']['elements']['0']['distance'])) {
                                    $cotacaoSuccess = true;
                                    $cotacaoKms = $cotacao['rows']['0']['elements']['0']['distance']['text'];
                                    $cotacaoKms = floatval($cotacaoKms);
                                }
                            }
                        }
                    }
                }
                $pedidoEntregaTable = $tableLocator->get('PedidosEntregas');
                $pedidoEntregaTable->getConnection()->begin();
                /** @var $cotacaoEntrega TaxasEntregasCotacao */
                $cotacaoEntrega = $tableLocator->get('TaxasEntregasCotacao')->find()->where(['ativo' => 1])->first();
                /** @var $newPedidoEntrega PedidosEntrega */
                $newPedidoEntrega = $pedidoEntregaTable->newEntity();
                $newPedidoEntrega->pedido_id = $newPedido->id;
                $newPedidoEntrega->endereco_id = $enderecoClienteModel->id;
                if(isset($cotacao['rows']['0']['elements']['0'])){
                    $newPedidoEntrega->cotacao_maps = json_encode($cotacao['rows']['0']['elements']['0']);
                }
                if ($cotacaoSuccess && $cotacaoKms) {
                    $valorEntrega = ($cotacaoEntrega->valor_km * $cotacaoKms);
                    //Arrendonda pro mais perto
                    if ($cotacaoEntrega->arredondamento_tipo === TaxasEntregasCotacao::TIPO_CENTRAL) {
                        $valorEntrega = round($valorEntrega);
                    //Arrendonda pra cima
                    } elseif ($cotacaoEntrega->arredondamento_tipo === TaxasEntregasCotacao::TIPO_SUPERIOR) {
                        $valorEntrega = floor($valorEntrega);
                    //Arrendonda pra baixo
                    } elseif ($cotacaoEntrega->arredondamento_tipo === TaxasEntregasCotacao::TIPO_INFERIOR) {
                        $valorEntrega = ceil($valorEntrega);
                    }
                    $newPedidoEntrega->valor_entrega = $valorEntrega;
                } else {
                    $newPedidoEntrega->valor_entrega = $cotacaoEntrega->valor_base_erro;
                }
                if ($pedidoEntregaTable->save($newPedidoEntrega)) {

                } else {
                    throw new \Exception('Erro ao cadastrar entrega');
                }
            }
            $this->Pedidos->getConnection()->commit();
            $pedidosProdutosTable->getConnection()->commit();
            $itensCarrinhoTable->getConnection()->commit();
            if ($endereco != 'retirar-no-local') {
                $pedidoEntregaTable->getConnection()->commit();
            }
            $success = true;
        } catch (\Exception $exception) {
            $success = false;
            $this->Pedidos->getConnection()->rollback();
            $pedidosProdutosTable->getConnection()->rollback();
            $itensCarrinhoTable->getConnection()->rollback();
            $pedidoEntregaTable->getConnection()->rollback();
        }

        echo json_encode(['success' => $success, 'pedido' => $newPedido->id]);
    }

    public function rejeitarPedidoAberto(){
        $this->render(false);
        $success = false;
        if ($this->forceAlterarSituacao(Pedido::STATUS_CANCELADO_CLIENTE)){
            $success = true;
        }
        echo json_encode(['success'=> $success]);
    }

    public function confirmarPedidoAberto($formaPagamento = null){
        $this->render(false);
        try{
            $this->Pedidos->getConnection()->begin();
            $success = $this->forceAlterarSituacao(Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA);
            if($success){
                /** @var $pedido Pedido*/
                $this->getPedidoSession()->formas_pagamento_id = intval($formaPagamento);
                if($this->Pedidos->save($this->getPedidoSession())){
                    $this->Pedidos->getConnection()->commit();
                    $msg = 'Sucesso';
                }else{
                    throw new Exception('Não foi possível vincular forma de pagamento ao pedido, se o problema persistir comunique a empresa');
                }
            }else{
                throw new Exception('Não foi possível alterar a situação do pedido, se o problema persistir comunique a empresa');
            }
        }catch (Exception $exception){
            $success = false;
            $msg = $exception->getMessage();
            $this->Pedidos->getConnection()->rollback();
        }
        echo json_encode(['success' => $success, 'message'=>$msg]);
    }

    private function forceAlterarSituacao($situacao){
        $tableLocator = new TableLocator();
        /** @var $tablePedidos PedidosTable*/
        $tablePedidos = $tableLocator->get('Pedidos');
        $validator = new ValidaPedidoAbertoCliente();
        /** @var $pedido Pedido*/
        $pedido = $validator->existsPedidoEmAberto($this->Auth->user('id'), true);
        if($pedido){
            $this->setPedidoSession($pedido);
            $pedido->status_pedido = $situacao;
            if($tablePedidos->save($pedido)){
                return true;
            }
        }
        return false;
    }

    public function saveTrocoPara($trocoPara){
        $this->render(false);
        $success = false;
        $validator = new ValidaPedidoAbertoCliente();
        /** @var $pedido Pedido*/
        $pedido = $validator->existsPedidoEmAberto($this->Auth->user('id'), true);
        $pedido->troco_para = floatval($trocoPara);
        if($this->Pedidos->save($pedido)){
            $success = true;
        }
        echo json_encode(['success' => $success]);
    }

    public function calcularAcrescimo($formaPagamentoId){
        $this->render(false);
        $success = false;
        $reload = true;
        $tableLocator = new TableLocator();
        $validator = new ValidaPedidoAbertoCliente();
        $formaPagamentoTable = $tableLocator->get('FormasPagamentos');
        /** @var $formaPagamento FormasPagamento*/
        $formaPagamento = $formaPagamentoTable->find()->where(['id' => $formaPagamentoId])->first();
        if($formaPagamento){
            /** @var $pedido Pedido*/
            $pedido = $validator->existsPedidoEmAberto($this->Auth->user('id'), true);
            $pedido->formas_pagamento_id = $formaPagamento->id;

            if($formaPagamento->aumenta_valor){
                $acrescimo = $pedido->valor_total_cobrado * ($formaPagamento->aumenta_valor/100);
                $pedido->valor_acrescimo = $acrescimo;
            }else{
                $pedido->valor_acrescimo = 0;
            }
            if(!$formaPagamento->necessita_troco){
                $pedido->troco_para = 0;
            }
            if($this->Pedidos->save($pedido)){
                $success = true;
                $reload = true;
            }
            if(!$formaPagamento->aumenta_valor){
                $reload = false;
            }
        }else{
            $success = false;
            $reload = true;
        }
        echo json_encode(['success' => $success, 'reload' => $reload]);
    }

    public function aplicarCupom($cupom = null){
        $tableLocator = new TableLocator();
        $validator = new ValidaPedidoAbertoCliente();
        $this->render(false);
        $success = false;
        if($cupom){
            $cupom = strtoupper($cupom);
            /** @var $cupomModel CupomSite*/
            $cupomTable = $tableLocator->get('CupomSite');
            $cupomModel = $cupomTable->find()->where(['nome_cupom' => $cupom ,'maximo_vezes_usar' => 0])->first();
            if(!$cupomModel){
                $cupomModel = $cupomTable->find()->where(['nome_cupom' => $cupom,'vezes_usado < maximo_vezes_usar'])->first();
            }
            if($cupomModel){
                $cupomModel->vezes_usado++;
                /** @var $pedido Pedido*/
                $pedido = $validator->existsPedidoEmAberto($this->Auth->user('id'), true);
                if($pedido){
                    $valorDesconto = 0;
                    if ($cupomModel->porcentagem){
                        $valorDesconto = $pedido->valor_total_cobrado * ($cupomModel->valor_desconto / 100);
                    }else{
                        $valorDesconto =  $cupomModel->valor_desconto;
                    }
                    if($valorDesconto > 0){
                        $pedido->valor_desconto = $valorDesconto;
                        $pedido->cupom_usado = $cupom;
                        if($this->Pedidos->save($pedido)){
                            $success = true;
                            $cupomTable->save($cupomModel);
                        }else{
                            $success = false;
                        }
                    }
                }else{
                    $success = false;
                }
            }else{
                $success = false;
            }
        }
        echo json_encode(['success' => $success]);
    }

    public function view($id = null){
        $pedido = $this->Pedidos->get($id);
        $this->set('pedido', $pedido);
    }

    /**
     * @return Pedido
     */
    public function getPedidoSession()
    {
        return $this->pedidoSession;
    }

    /**
     * @param Pedido $pedidoSession
     */
    public function setPedidoSession($pedidoSession)
    {
        $this->pedidoSession = $pedidoSession;
    }


}