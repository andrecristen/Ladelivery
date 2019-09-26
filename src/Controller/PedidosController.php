<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\CupomSite;
use App\Model\Entity\Empresa;
use App\Model\Entity\Endereco;
use App\Model\Entity\EnderecosEmpresa;
use App\Model\Entity\FormasPagamento;
use App\Model\Entity\GoogleMapsApiKey;
use App\Model\Entity\ItensCarrinho;
use App\Model\Entity\Lista;
use App\Model\Entity\OpcoesExtra;
use App\Model\Entity\Pedido;
use App\Model\Entity\PedidosEntrega;
use App\Model\Entity\PedidosProduto;
use App\Model\Entity\Produto;
use App\Model\Entity\TaxasEntregasCotacao;
use App\Model\Entity\TaxasEntregasCotacaoFaixa;
use App\Model\Entity\TemposMedio;
use App\Model\Entity\User;
use App\Model\ExceptionSQLMessage;
use App\Model\Table\PedidosProdutosTable;
use App\Model\Table\PedidosTable;
use App\Model\Utils\EmpresaUtils;
use App\Model\Utils\SiteUtilsPedido;
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
    const PEDIDOS_NOVOS = 1;
    const PEDIDOS_EM_PRODUCAO = 2;
    const PEDIDOS_AGUARDANDO_COLETA_CLIENTE = 3;
    const PEDIDOS_AGUARDANDO_ENTREGA = 4;
    const PEDIDOS_EM_ROTA = 5;
    const PEDIDOS_ENTREGUES = 6;

    /** @var  $pedidoSession Pedido */
    protected $pedidoSession;

    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->setPublicAction('generatePedido');
        $this->setPublicAction('aplicarCupom');
        $this->setPublicAction('calcularAcrescimo');
        $this->setPublicAction('rejeitarPedidoAberto');
        $this->setPublicAction('confirmarPedidoAberto');
        $this->setPublicAction('saveTrocoPara');
        $this->setPublicAction('meusPedidos');
        $this->setPublicAction('meusPedidosHistorico');
        $this->setPublicAction('verStatus');
        $this->setPublicAction('getNewValues');
        $this->validateActions();
        $this->empresaUtils = new EmpresaUtils();
    }

    public function add($isComanda = false)
    {
        /** @var $pedido Pedido */
        $pedido = $this->instanceNewPedido($isComanda);
        if ($this->request->is('post')) {
            if ($isComanda) {
                $pedido = $this->beanModelComanda($pedido, $this->request->getData());
            } else {
                $pedido = $this->beanModelPedido($pedido, $this->request->getData());
            }
            $pedido->origem = Pedido::ORIGEM_SITE_ADMIN;
            if ($this->Pedidos->save($pedido)) {
                $this->Flash->success(__('Pedido aberto com sucesso.'));
                if ($isComanda) {
                    $this->Flash->success(__('Comanda aberta com sucesso.'));
                    return $this->redirect(['action' => 'addItem', $pedido->id]);
                }
                return $this->redirect(['action' => 'defineEntrega', $pedido->id]);
            }
            $this->Flash->error(__('Não foi possível abrir, tente novamente.'));
        }

        if ($isComanda) {
            $users = null;
        } else {
            $users = $this->getTableLocator()->get('Users')->find('list')->where(['tipo' => User::TIPO_CLIENTE]);
            $formasPagamento = $this->getTableLocator()->get('FormasPagamentos')->find('list')->where(['empresa_id' => $this->empresaUtils->getUserEmpresaId()]);
        }
        $this->set(compact('pedido', 'isComanda', 'users', 'formasPagamento'));
    }

    public function addItem($id = null)
    {
        $pedido = $this->Pedidos->get($id, [
            'contain' => []
        ]);
        $this->set(compact('pedido'));
    }

    public function defineEntrega($id = null)
    {
        $pedido = $this->Pedidos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dados = $this->request->getData();
            if(isset($dados['endereco']) && $dados['endereco'] == 'on'){
               $dados['endereco_id'] = $this->instanceNewEndereco($dados, $pedido->user_id);
            }
            $valorEntregaFixed = false;
            if (is_float($dados['valor_entrega'])) {
                $valorEntregaFixed = floatval($dados['valor_entrega']);
            }
            try {
                $this->calcularEntrega($dados['endereco_id'], $pedido, $valorEntregaFixed);
                $temposMediosTable = $this->getTableLocator()->get('TemposMedios');
                if ($dados['endereco_id'] == Pedido::RETIRAR_NO_LOCAL) {
                    $tempoMedio = $pedido->tempo_producao_aproximado_minutos = $temposMediosTable->find()->where(['ativo' => true, 'tipo' => TemposMedio::TIPO_PARA_COLETA, 'empresa_id' => $pedido->empresa_id])->first();
                } else {
                    $tempoMedio = $temposMediosTable->find()->where(['ativo' => true, 'tipo' => TemposMedio::TIPO_PARA_ENTREGA, 'empresa_id' => $pedido->empresa_id])->first();
                }
                $tempoMinutos = 60;
                if($tempoMedio){
                    /** @var $tempoMedio TemposMedio */
                    $tempoMinutos = $tempoMedio->tempo_medio_producao_minutos;
                }
                $pedido->tempo_producao_aproximado_minutos = $tempoMinutos;
                if($this->Pedidos->save($pedido)){
                    $this->Flash->success(__('Entrega vinculada com sucesso.'));
                    return $this->redirect(['action' => 'addItem', $pedido->id]);
                }else{
                    throw new \Exception('Erro ao salvar pedido');
                }
            } catch (\Exception $exception) {
                $exMessage = new ExceptionSQLMessage();
                $this->Flash->error(__($exMessage->getMessage($exception)));
            }
        }
        $users = $this->getTableLocator()->get('Users')->find('list')->where(['tipo' => User::TIPO_CLIENTE]);
        /** @var $enderecosClienteModel Endereco[] */
        $enderecosClienteModel = $this->getTableLocator()->get('Enderecos')->find()->where(['user_id' => $pedido->user_id]);
        $enderecosCliente = [];
        foreach ($enderecosClienteModel as $endereco) {
            $enderecosCliente[$endereco->id] = "Rua: " . $endereco->rua . " Número: " . $endereco->numero . " Bairro: " . $endereco->bairro . ", " . $endereco->cidade . "-" . $endereco->estado;
        }
        $enderecosCliente[Pedido::RETIRAR_NO_LOCAL] = 'Cliente irá buscar o pedido';
        $this->set(compact('pedido', 'users', 'enderecosCliente'));
    }

    private function instanceNewEndereco($dados, $user){
        $empresaUtils = new EmpresaUtils();
        if(!$user){
            //Se nao tem nosso cliente gravamos o endereco para o usuario da empresa
            $user = $empresaUtils->getEmpresaBaseModel()->user_id;
        }
        $endereco = new Endereco();
        $endereco->user_id = $user;
        $endereco->rua = $dados['rua'];
        $endereco->numero = $dados['numero'];
        $endereco->bairro = $dados['bairro'];
        $endereco->cidade = $dados['cidade'];
        $endereco->estado = $dados['estado'];
        $endereco->cep = $dados['cep'];
        $endereco->complemento = $dados['complemento'];
        $enderecosTable = $this->getTableLocator()->get('Enderecos');
        if($enderecosTable->save($endereco)){
            return $endereco->id;
        }
        return null;
    }

    private function instanceNewPedido($isComanda)
    {
        $pedido = new Pedido();
        $pedido->empresa_id = $this->empresaUtils->getUserEmpresaId();
        $pedido->status_pedido = Pedido::STATUS_EM_ABERTURA;
        $pedido->tipo_pedido = Pedido::TIPO_PEDIDO_DELIVERY;
        $pedido->data_pedido = new \DateTime();
        $pedido->valor_produtos = 0;
        $pedido->valor_desconto = 0;
        $pedido->valor_acrescimo = 0;
        $pedido->troco_para = 0;
        if ($isComanda) {
            $pedido->tipo_pedido = Pedido::TIPO_PEDIDO_COMANDA;
        }
        return $pedido;
    }

    private function beanModelPedido($pedido, $data)
    {
        $pedido->user_id = $data['user_id'] ? $data['user_id'] :  $this->empresaUtils->getUserEmpresaModel()->user_id;
        $pedido->cliente = $data['cliente'];
        $pedido->formas_pagamento_id = $data['formas_pagamento_id'];
        return $pedido;
    }

    private function beanModelComanda($pedido, $data)
    {
        $pedido->user_id = $this->empresaUtils->getUserId();
        $pedido->cliente = $data['cliente'];
        return $pedido;
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
        $filtersFixed = ['tipo_pedido' => Pedido::TIPO_PEDIDO_DELIVERY,
            'status_pedido <> ' => Pedido::STATUS_AGUARDANDO_CONFIRMACAO_CLIENTE];
        $pedidos = $this->paginate($this->Pedidos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('id', SORT_DESC);

        $this->set(compact('pedidos'));
    }

    public function getNewValues($onlyNew = false){
        $this->render(false);
        if($onlyNew){
            $values = $this->countNovos();
        }else{
            $values = [
                'novos' => $this->countNovos(),
                'producao' => $this->countProducao(),
                'coleta' => $this->countColeta(),
                'entrega' => $this->countEntrega(),
                'emRota' => $this->countEmRota(),
                'entregue' => $this->countEntregue(),
            ];
        }
        echo json_encode($values);
    }

    public function countNovos(){
        return $this->Pedidos->find()->where([
            'status_pedido' => Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA,
            'empresa_id' => $this->empresaUtils->getUserEmpresaId()
        ])->count();
    }

    public function countProducao(){
       return $this->Pedidos->find()->where([
           'status_pedido' => Pedido::STATUS_EM_PRODUCAO,
           'empresa_id' => $this->empresaUtils->getUserEmpresaId()
       ])->count();
    }

    public function countColeta(){
        return  $this->Pedidos->find()->where([
            'status_pedido' => Pedido::STATUS_AGUARDANDO_COLETA_CLIENTE,
            'empresa_id' => $this->empresaUtils->getUserEmpresaId()
        ])->count();
    }

    public function countEntrega(){
        return $this->Pedidos->find()->where([
            'status_pedido' => Pedido::STATUS_AGUARDANDO_ENTREGADOR,
            'empresa_id' => $this->empresaUtils->getUserEmpresaId()
        ])->count();
    }

    public function countEmRota(){
        return $this->Pedidos->find()->where([
            'status_pedido' => Pedido::STATUS_SAIU_PARA_ENTREGA,
            'empresa_id' => $this->empresaUtils->getUserEmpresaId()
        ])->count();
    }

    public function countEntregue(){
        $data = new \DateTime();
        return $this->Pedidos->find()->where([
            'status_pedido' => Pedido::STATUS_ENTREGUE,
            'empresa_id' => $this->empresaUtils->getUserEmpresaId(),
            'MONTH(data_pedido)' => $data->format('m'),
            'YEAR(data_pedido)' => $data->format('Y'),
        ])->count();
    }


    public function listAll()
    {
        $novos = $this->countNovos();
        $producao = $this->countProducao();
        $coleta = $this->countColeta();
        $entrega = $this->countEntrega();
        $emRota = $this->countEmRota();
        $entregue = $this->countEntregue();
        $this->set(compact('novos', 'producao', 'coleta', 'entrega', 'emRota', 'entregue'));
    }

    public function novos()
    {
        $this->paginate = [
            'contain' => ['Users', 'FormasPagamentos']
        ];
        $filtersFixed = [
            'tipo_pedido' => Pedido::TIPO_PEDIDO_DELIVERY,
            'status_pedido' => Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA
        ];
        $pedidos = $this->paginate($this->Pedidos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('data_pedido', SORT_ASC);
        $title = $this->getTituloPage(self::PEDIDOS_NOVOS);
        $this->set(compact('pedidos', 'title'));
    }

    public function entregues()
    {
        $data = new \DateTime();
        $this->paginate = [
            'contain' => ['Users', 'FormasPagamentos']
        ];
        $filtersFixed = [
            'tipo_pedido' => Pedido::TIPO_PEDIDO_DELIVERY,
            'status_pedido' => Pedido::STATUS_ENTREGUE,
            'MONTH(data_pedido)' => $data->format('m'),
            'YEAR(data_pedido)' => $data->format('Y'),
        ];
        $pedidos = $this->paginate($this->Pedidos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('data_pedido', SORT_ASC);
        $title = $this->getTituloPage(self::PEDIDOS_ENTREGUES);
        $this->set(compact('pedidos', 'title'));
    }

    public function producao()
    {
        $this->paginate = [
            'contain' => ['Users', 'FormasPagamentos']
        ];
        $filtersFixed = [
            'tipo_pedido' => Pedido::TIPO_PEDIDO_DELIVERY,
            'status_pedido' => Pedido::STATUS_EM_PRODUCAO
        ];
        $pedidos = $this->paginate($this->Pedidos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('id', SORT_DESC);
        $title = $this->getTituloPage(self::PEDIDOS_EM_PRODUCAO);
        $this->set(compact('pedidos', 'title'));
    }

    public function coleta()
    {
        $this->paginate = [
            'contain' => ['Users', 'FormasPagamentos']
        ];
        $filtersFixed = [
            'tipo_pedido' => Pedido::TIPO_PEDIDO_DELIVERY,
            'status_pedido' => Pedido::STATUS_AGUARDANDO_COLETA_CLIENTE
        ];
        $pedidos = $this->paginate($this->Pedidos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('id', SORT_DESC);
        $title = $this->getTituloPage(self::PEDIDOS_AGUARDANDO_COLETA_CLIENTE);
        $this->set(compact('pedidos', 'title'));
    }

    public function entrega()
    {
        $this->paginate = [
            'contain' => ['Users', 'FormasPagamentos']
        ];
        $filtersFixed = [
            'tipo_pedido' => Pedido::TIPO_PEDIDO_DELIVERY,
            'status_pedido' => Pedido::STATUS_AGUARDANDO_ENTREGADOR
        ];
        $pedidos = $this->paginate($this->Pedidos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('id', SORT_DESC);
        $title = $this->getTituloPage(self::PEDIDOS_AGUARDANDO_ENTREGA);
        $this->set(compact('pedidos', 'title'));
    }

    public function emRota()
    {
        $this->paginate = [
            'contain' => ['Users', 'FormasPagamentos']
        ];
        $filtersFixed = [
            'tipo_pedido' => Pedido::TIPO_PEDIDO_DELIVERY,
            'status_pedido' => Pedido::STATUS_SAIU_PARA_ENTREGA
        ];
        $pedidos = $this->paginate($this->Pedidos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('id', SORT_DESC);
        $title = $this->getTituloPage(self::PEDIDOS_EM_ROTA);
        $this->set(compact('pedidos', 'title'));
    }


    public function concluirPedido($id = null)
    {
        $pedido = $this->Pedidos->get($id, [
            'contain' => []
        ]);
        $entrega = $this->getTableLocator()->get('PedidosEntregas')->find()->where(['pedido_id' => $pedido->id])->first();
        $pedido->status_pedido = Pedido::STATUS_AGUARDANDO_COLETA_CLIENTE;
        if ($entrega) {
            $pedido->status_pedido = Pedido::STATUS_AGUARDANDO_ENTREGADOR;
        }
        if ($this->Pedidos->save($pedido)) {
            $this->Flash->success(__('Produção do pedido concluida com sucesso.'));
            return $this->redirect(['action' => 'producao']);
        }
        $this->Flash->error(__('Não foi possivel colocar o status do pedido para o esperado.'));
    }

    public function setColetado($id = null)
    {
        $pedido = $this->Pedidos->get($id, [
            'contain' => []
        ]);
        $pedido->status_pedido = Pedido::STATUS_ENTREGUE;
        if ($this->Pedidos->save($pedido)) {
            $this->Flash->success(__('Pedido definido como coletado pelo cliente.'));
            return $this->redirect(['action' => 'coleta']);
        }
        $this->Flash->error(__('Não foi possivel colocar o status do pedido para o esperado.'));
    }

    public function setEntregue($id = null)
    {
        $pedido = $this->Pedidos->get($id, [
            'contain' => []
        ]);
        $pedido->status_pedido = Pedido::STATUS_ENTREGUE;
        if ($this->Pedidos->save($pedido)) {
            $this->Flash->success(__('Pedido definido como entregue ao cliente.'));
            return $this->redirect(['action' => 'emRota']);
        }
        $this->Flash->error(__('Não foi possivel colocar o status do pedido para o esperado.'));
    }

    public function setSaiuParaEntrega($id = null)
    {
        $pedido = $this->Pedidos->get($id, [
            'contain' => []
        ]);
        $pedido->status_pedido = Pedido::STATUS_SAIU_PARA_ENTREGA;
        if ($this->Pedidos->save($pedido)) {
            $this->Flash->success(__('Pedido definido em rota de entrega.'));
            return $this->redirect(['action' => 'entrega']);
        }
        $this->Flash->error(__('Não foi possivel colocar o status do pedido para o esperado.'));
    }

    private function getTituloPage($tipo)
    {
        switch ($tipo) {
            case self::PEDIDOS_NOVOS:
                return 'Novos Pedidos';
                break;
            case self::PEDIDOS_EM_PRODUCAO:
                return 'Pedidos em produção';
                break;
            case self::PEDIDOS_AGUARDANDO_COLETA_CLIENTE:
                return 'Pedidos aguardando coleta do cliente';
                break;
            case self::PEDIDOS_AGUARDANDO_ENTREGA:
                return 'Pedidos aguardando entrega';
                break;
            case self::PEDIDOS_EM_ROTA:
                return 'Pedidos sendo entregues';
                break;
            case self::PEDIDOS_ENTREGUES:
                return 'Pedidos entregues';
                break;
        }
    }

    public function comandas()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $filtersFixed = ['tipo_pedido' => Pedido::TIPO_PEDIDO_COMANDA];
        $pedidos = $this->paginate($this->Pedidos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('id', SORT_DESC);
        $this->set(compact('pedidos'));
    }

    public function alterarSituacao($id = null)
    {
        $pedido = $this->Pedidos->get($id);
        $tipoPedido = $pedido->tipo_pedido;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pedido = $this->Pedidos->patchEntity($pedido, $this->request->getData());
            if ($this->Pedidos->save($pedido)) {
                $this->Flash->success(__('Situação Alterada com sucesso.'));
                if ($tipoPedido == Pedido::TIPO_PEDIDO_DELIVERY) {
                    return $this->redirect(['action' => 'index']);
                }
                return $this->redirect(['action' => 'comandas']);
            }
            $this->Flash->error(__('Não foi possível alterar a situação, tente novamente.'));
        }
        $this->set(compact('pedido'));
    }

    public function imprimir($id = null)
    {
        $pedido = $this->Pedidos->get($id);
        $itensBar = [];
        $itensCozinha = [];
        $adicionais = [];
        $tableLocator = new TableLocator();
        $pedidosProdutos = $tableLocator->get('PedidosProdutos')->find()->where(['pedido_id' => $pedido->id, 'status' => PedidosProduto::STATUS_EM_FILA_PRODUCAO]);
        foreach ($pedidosProdutos as $item) {
            $produto = $tableLocator->get('Produtos')->find()->where(['id' => $item->produto_id])->first();
            $categoria = $tableLocator->get('CategoriasProdutos')->find()->where(['id' => $produto->categorias_produto_id])->first();
            if ($item->ambiente_producao_responsavel == PedidosProduto::RESPONSAVEL_COZINHA) {
                $itensCozinha[$item->id]['categoria'] = $categoria->nome_categoria;
                $itensCozinha[$item->id]['produto'] = $produto->nome_produto;
                $itensCozinha[$item->id]['observacao'] = $item->observacao;
                $itensCozinha[$item->id]['id'] = $item->id;
            } else {
                $itensBar[$item->id]['categoria'] = $categoria->nome_categoria;
                $itensBar[$item->id]['produto'] = $produto->nome_produto;
                $itensBar[$item->id]['observacao'] = $item->observacao;
                $itensBar[$item->id]['id'] = $item->id;
            }
            $adicionais[$item->id] = $this->getAdicionais($item);
        }
        $this->set(compact('pedido', 'itensBar', 'itensCozinha', 'adicionais'));
    }

    public function gerenciarItens($id = null){
        $pedido = $this->Pedidos->get($id);
        $statusList = PedidosProduto::getAllStatusList();
        /** @var $pedidosProdutos PedidosProduto[]*/
        $pedidosProdutos = $this->getTableLocator()->get('PedidosProdutos')->find()->where(['pedido_id' => $pedido->id]);
        foreach ($pedidosProdutos as $item) {
            $produto = $this->getTableLocator()->get('Produtos')->find()->where(['id' => $item->produto_id])->first();
            $categoria = $this->getTableLocator()->get('CategoriasProdutos')->find()->where(['id' => $produto->categorias_produto_id])->first();
            if ($item->ambiente_producao_responsavel == PedidosProduto::RESPONSAVEL_COZINHA) {
                $itensCozinha[$item->id]['categoria'] = $categoria->nome_categoria;
                $itensCozinha[$item->id]['produto'] = $produto->nome_produto;
                $itensCozinha[$item->id]['observacao'] = $item->observacao;
                $itensCozinha[$item->id]['valorTotal'] = $item->valor_total_cobrado;
                $itensCozinha[$item->id]['status'] = $statusList[$item->status];
                $itensCozinha[$item->id]['id'] = $item->id;
            } else {
                $itensBar[$item->id]['categoria'] = $categoria->nome_categoria;
                $itensBar[$item->id]['produto'] = $produto->nome_produto;
                $itensBar[$item->id]['observacao'] = $item->observacao;
                $itensBar[$item->id]['valorTotal'] = $item->valor_total_cobrado;
                $itensBar[$item->id]['status'] = $statusList[$item->status];
                $itensBar[$item->id]['id'] = $item->id;
            }
            $adicionais[$item->id] = $this->getAdicionais($item);
        }
        $this->set(compact('pedido', 'itensBar', 'itensCozinha', 'adicionais'));
    }

    /**
     * Retorna um array contendo os adicionais de um item.
     * @uses Usado tanto na visualizacao de pedido, pedidoItem e impressao de pedido! CUIDADO COM MANUTENCAO
     */
    public function getAdicionais(PedidosProduto $pedidoProduto)
    {
        $tableLocator = new TableLocator();
        $adicionais = [];
        $adicionaisItemAtual = json_decode($pedidoProduto->opcionais, true);
        if (count($adicionaisItemAtual) > 0) {
            foreach ($adicionaisItemAtual as $idLista => $opcionais) {
                /** @var $listaModel Lista */
                $listaModel = $tableLocator->get('Listas')->find()->where(['id' => $idLista])->first();
                foreach ($opcionais as $opcional) {
                    /** @var $opcionalModel OpcoesExtra */
                    $opcionalModel = $tableLocator->get('OpcoesExtras')->find()->where(['id' => $opcional])->first();
                    $opcaoAtual = [];
                    $opcaoAtual['lista'] = $listaModel->nome_lista;
                    $opcaoAtual['lista_id'] = $listaModel->id;
                    $opcaoAtual['nomeAdicional'] = $opcionalModel->nome_adicional;
                    $opcaoAtual['adicional_id'] = $opcionalModel->id;
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
        /** @var $produtosTable PedidosProdutosTable */
        $produtosTable = $tableLocator->get('PedidosProdutos');
        /** @var $produtosPedidos PedidosProduto */
        $produtosPedidos = $produtosTable->find()->where(['pedido_id' => $pedido->id]);
        $produtosFinal = [];
        $adicionais = [];
        foreach ($produtosPedidos as $produtoPedido) {
            $produtosFinal[] = $produtoPedido;
            $adicionaisItem = json_decode($produtoPedido->opcionais, true);
            foreach ($adicionaisItem as $idLista => $lista) {
                /** @var $listaModel Lista */
                $listaModel = $tableLocator->get('Listas')->find()->where(['id' => $idLista])->first();
                //$adicionais[$produtoPedido->id][$listaModel->id] = $this->getAdicionais($produtoPedido);
                $adicionais[$produtoPedido->id][$listaModel->nome_lista] = [];
                $opcionais = [];
                foreach ($lista as $opcional) {
                    /** @var $opcionalModel OpcoesExtra */
                    $opcionalModel = $tableLocator->get('OpcoesExtras')->find()->where(['id' => $opcional])->first();
                    $opcionais[$opcionalModel->id]['nome'] = $opcionalModel->nome_adicional;
                    $opcionais[$opcionalModel->id]['descricao'] = $opcionalModel->descricao_adicional;
                }
                $adicionais[$produtoPedido->id][$listaModel->nome_lista] = $opcionais;
            }
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $successStatus = false;
            $pedido->status_pedido = Pedido::STATUS_EM_PRODUCAO;
            if ($this->Pedidos->save($pedido)) {
                $successStatus = true;
            }
            $produtosTable->getConnection()->begin();
            $gravouTodosItens = true;
            foreach ($produtosFinal as $item) {
                $data = $this->getRequest()->getData();
                $item->status = PedidosProduto::STATUS_EM_FILA_PRODUCAO;
                if ($produtosTable->save($item)) {

                } else {
                    $gravouTodosItens = false;
                }
            }
            if ($gravouTodosItens && $successStatus) {
                $produtosTable->getConnection()->commit();
                $this->Flash->success(__('Pedido Confirmado Com Sucesso.'));
                return $this->redirect(['action' => 'novos']);
            } else {
                $produtosTable->getConnection()->rollback();
                $this->Flash->error(__('Não foi possível destinar os produtosPedidos ao seu setor responsavel, tente novamente.'));
            }
        }
        //$pedido->status_pedido = Pedido::STATUS_EM_SEPARACAO_PARA_PRODUCAO;
        //$this->Pedidos->save($pedido);
        $this->set(compact('pedido', 'produtosFinal', 'adicionais'));
    }

    public function rejeitar($id = null)
    {
        $success = true;
        $tableLocator = $this->getTableLocator();
        $pedido = $this->Pedidos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->Pedidos->getConnection()->begin();
            $pedido->status_pedido = Pedido::STATUS_REJEITADO;
            $pedido->motivo_rejeicao = $this->getRequest()->getData('motivo_rejeicao');
            /** @var $produtosPedidoTable PedidosProdutosTable */
            $produtosPedidoTable = $tableLocator->get('PedidosProdutos');
            $produtosPedido = $produtosPedidoTable->find()->where(['pedido_id' => $pedido->id]);
            $produtosPedidoTable->getConnection()->begin();
            /** @var $produto PedidosProduto */
            foreach ($produtosPedido as $produto) {
                $produto->status = PedidosProduto::STATUS_PEDIDO_REJEITADO;
                if (!$produtosPedidoTable->save($produto)) {
                    $success = false;
                };
            }
            if (!$this->Pedidos->save($pedido)) {
                $success = false;
            }
            if ($success) {
                $this->Flash->success(__('Pedido Rejeitado Com Sucesso.'));
                $produtosPedidoTable->getConnection()->commit();
                $this->Pedidos->getConnection()->commit();
                return $this->redirect(['action' => 'novos']);
            } else {
                $produtosPedidoTable->getConnection()->rollback();
                $this->Pedidos->getConnection()->rollback();
                $this->Flash->error(__('Não foi possível rejeitar o pedido, tente novamente.'));
            }
        }
        $users = $this->getTableLocator()->get('Users')->find('list')->where(['id' => $pedido->user_id]);
        $this->set(compact('pedido', 'users'));
    }

    private function calcularEntrega($endereco, $newPedido, $valorEntregaFixed = false)
    {
        if ($endereco == Pedido::RETIRAR_NO_LOCAL) {
            return;
        }
        $tableLocator = $this->getTableLocator();
        $pedidoEntregaTable = $tableLocator->get('PedidosEntregas');
        /** @var $enderecoClienteModel Endereco */
        $enderecoClienteModel = $tableLocator->get('Enderecos')->find()->where(['id' => $endereco])->first();
        /** @var $newPedidoEntrega PedidosEntrega */
        $newPedidoEntrega = $pedidoEntregaTable->newEntity();
        $newPedidoEntrega->pedido_id = $newPedido->id;
        $newPedidoEntrega->endereco_id = $enderecoClienteModel->id;
        if ($valorEntregaFixed) {
            $newPedidoEntrega->valor_entrega = $valorEntregaFixed;
        } else {
            $ruaFinal = str_replace(' ', '%20', $enderecoClienteModel->rua);
            $numeroFinal = str_replace(' ', '%20', $enderecoClienteModel->numero);
            $bairroFinal = str_replace(' ', '%20', $enderecoClienteModel->bairro);
            $cidadeFinal = str_replace(' ', '%20', $enderecoClienteModel->cidade);
            $estadoFinal = str_replace(' ', '%20', $enderecoClienteModel->estado);
            /** @var $enderecoEmpresaModel EnderecosEmpresa */
            $enderecoEmpresaModel = $tableLocator->get('EnderecosEmpresas')->find()->where(['empresa_id' => $newPedido->empresa_id])->first();
            $ruaEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->rua);
            $numeroEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->numero);
            $bairroEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->bairro);
            $cidadeEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->cidade);
            $estadoEmpresaFinal = str_replace(' ', '%20', $enderecoEmpresaModel->estado);
            /** @var $key GoogleMapsApiKey */
            $key = $tableLocator->get('GoogleMapsApiKey')->find()->where(['empresa_id' => $newPedido->empresa_id])->first();
            $cotacao = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?&origins=Rua%20' . $ruaFinal . '%20' . $numeroFinal . ',%20' . $bairroFinal . ',%20' . $cidadeFinal . '-' . $estadoFinal . '&destinations=Rua%20' . $ruaEmpresaFinal . '%20' . $numeroEmpresaFinal . ',%20' . $bairroEmpresaFinal . ',%20' . $cidadeEmpresaFinal . '-' . $estadoEmpresaFinal . '&language=pt-BR&key=' . $key->api_key);
            $cotacao = json_decode($cotacao, true);
            $cotacaoSuccess = false;
            $cotacaoKms = false;
            if (isset($cotacao['rows'])) {
                if (isset($cotacao['rows']['0'])) {
                    if (isset($cotacao['rows']['0']['elements'])) {
                        if (isset($cotacao['rows']['0']['elements']['0'])) {
                            if (isset($cotacao['rows']['0']['elements']['0']['distance'])) {
                                $cotacaoSuccess = true;
                                //Pega em metros
                                $cotacaoKms = $cotacao['rows']['0']['elements']['0']['distance']['value'];
                                //Para KM
                                $cotacaoKms = floatval($cotacaoKms) / 1000;
                            }
                        }
                    }
                }
            }
            if (isset($cotacao['rows']['0']['elements']['0'])) {
                $newPedidoEntrega->cotacao_maps = json_encode($cotacao['rows']['0']['elements']['0']);
            }
            $empresa = $this->empresaUtils->getEmpresaBaseModel();
            if($empresa->tipo_frete == Empresa::FRETE_TIPO_KM){
                /** @var $cotacaoEntrega TaxasEntregasCotacao */
                $cotacaoEntrega = $tableLocator->get('TaxasEntregasCotacao')->find()->where(['empresa_id' => $newPedido->empresa_id, 'ativo' => 1])->first();
                if ($cotacaoSuccess && $cotacaoKms && $cotacaoEntrega) {
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
                    $newPedidoEntrega->valor_entrega = $empresa->valor_base_erro_frete;
                }
            }elseif ($empresa->tipo_frete == Empresa::FRETE_TIPO_FAIXA){
                /** @var $cotacaoEntregaFaixa TaxasEntregasCotacaoFaixa */
                $cotacaoEntregaFaixa = $tableLocator->get('TaxasEntregasCotacaoFaixas')->find()->where(['empresa_id' => $newPedido->empresa_id, 'ativo' => true, 'kilometro_inicio <=' => $cotacaoKms,  'kilometro_fim >=' => $cotacaoKms])->first();
                if ($cotacaoSuccess && $cotacaoKms !== false && $cotacaoEntregaFaixa) {
                    $newPedidoEntrega->valor_entrega = $cotacaoEntregaFaixa->valor;
                } else {
                    $newPedidoEntrega->valor_entrega = $empresa->valor_base_erro_frete;
                }
            }else{
                throw new \Exception('Empresa sem configuração de frete, informe a empresa para solução do problema.');
            }
        }
        if (!$pedidoEntregaTable->save($newPedidoEntrega)) {
            throw new \Exception('Erro ao criar entidade de entrega');
        }
    }

    public function confirmarAbertura($pedido)
    {
        $this->render(false);
        $this->Pedidos->getConnection()->begin();
        /** @var $pedido Pedido */
        $pedido = $this->Pedidos->find()->where(['id' => $pedido])->first();
        $pedidosProdutos = $this->getTableLocator()->get('PedidosProdutos')->find()->where(['pedido_id' => $pedido->id])->count();
        if ($pedidosProdutos < 1) {
            $this->Flash->error(__('Erro ao confirmar, por favor recarregue a página atual utilizando a tecla F5.'));
            return $this->redirect(['action' => 'addItem', $pedido->id]);
        }
        $successStatus = false;
        $tipoPedido = $pedido->tipo_pedido;
        if ($tipoPedido == Pedido::TIPO_PEDIDO_COMANDA) {
            $pedido->status_pedido = Pedido::STATUS_ABERTA;
        } else {
            $pedido->status_pedido = Pedido::STATUS_EM_PRODUCAO;
        }
        if ($this->Pedidos->save($pedido)) {
            $successStatus = true;
        }
        $gravouTodosItens = true;
        $produtosTable = $this->getTableLocator()->get('PedidosProdutos');
        $produtosFinal = $produtosTable->find()->where(['pedido_id' => $pedido->id]);
        foreach ($produtosFinal as $item) {
            $item->status = PedidosProduto::STATUS_EM_FILA_PRODUCAO;
            if ($produtosTable->save($item)) {

            } else {
                $gravouTodosItens = false;
            }
        }
        if ($gravouTodosItens && $successStatus) {
            $this->Pedidos->getConnection()->commit();
            if ($tipoPedido == Pedido::TIPO_PEDIDO_COMANDA) {
                $this->Flash->success(__('Comanda Confirmada Com Sucesso.'));
                return $this->redirect(['action' => 'comandas']);
            }
            $this->Flash->success(__('Pedido Confirmado Com Sucesso.'));
            return $this->redirect(['action' => 'producao']);
        } else {
            $this->Pedidos->getConnection()->rollback();
            $this->Flash->error(__('Não foi possível confirmar o pedido, tente novamente.'));
        }
    }

    private function persistProdutosPedido(Pedido $newPedido)
    {
        //Adiciona os itens que compoem este pedido
        $tableLocator = $this->getTableLocator();
        $itensCarrinhoTable = $tableLocator->get('ItensCarrinhos');
        $pedidosProdutosTable = $tableLocator->get('PedidosProdutos');
        $itensCarrinho = $itensCarrinhoTable->find()->where(['user_id' => $this->Auth->user('id')]);
        /** @var $item ItensCarrinho */
        $valoTotalProdutos = 0;
        foreach ($itensCarrinho as $item) {
            /** @var $newItem PedidosProduto */
            $newItem = $pedidosProdutosTable->newEntity();
            $newItem->pedido_id = $newPedido->id;
            $newItem->produto_id = $item->produto_id;
            $newItem->quantidade = $item->quantidades;
            $newItem->valor_total_cobrado = $item->valor_total_cobrado;
            $valoTotalProdutos = $valoTotalProdutos + $item->valor_total_cobrado;
            $newItem->observacao = $item->observacao;
            $newItem->opcionais = $item->opicionais;
            /** @var $produto Produto */
            $produto = $this->getTableLocator()->get('Produtos')->find()->where(['id' => $item->produto_id])->first();
            $newItem->ambiente_producao_responsavel = $produto->ambiente_producao_responsavel;
            $newItem->status = PedidosProduto::STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO;
            if (!$pedidosProdutosTable->save($newItem)) {
                throw new \Exception('Erro ao cadastrar item');
            }
            if (!$itensCarrinhoTable->delete($item)) {
                throw new \Exception('Erro ao excluir item do carrinho');
            }
        }
        //Altera o valor final do pedido com base nos itens lidos.
        $newPedido->valor_produtos = $valoTotalProdutos;
        return $newPedido;
    }

    public function generatePedido($endereco = null)
    {
        $tableLocator = $this->getTableLocator();
        $msg = 'Confirmação de itens concluida com sucesso';
        try {
            //Cria um novo pedido
            $this->Pedidos->getConnection()->begin();
            $newPedido = $this->Pedidos->newEntity();
            $newPedido->user_id = $this->Auth->user('id');
            $newPedido->valor_produtos = 0;
            $newPedido->status_pedido = Pedido::STATUS_AGUARDANDO_CONFIRMACAO_CLIENTE;
            $dateTime = new  \DateTime();
            $dateTime->setTime($dateTime->format("H"), $dateTime->format('i'), 0);
            $newPedido->data_pedido = $dateTime;
            $newPedido->empresa_id = $this->empresaUtils->getEmpresaBase();
            $newPedido->origem = Pedido::ORIGEM_SITE_CLIENTE;
            if ($endereco != Pedido::RETIRAR_NO_LOCAL) {
                $tempoMedio = $tableLocator->get('TemposMedios')->find()->where(['ativo' => true, 'tipo' => TemposMedio::TIPO_PARA_ENTREGA]);
            } else {
                $tempoMedio = $tableLocator->get('TemposMedios')->find()->where(['ativo' => true, 'tipo' => TemposMedio::TIPO_PARA_COLETA]);
            }
            $tempoFinal = 0;
            if ($tempoMedio->first()) {
                /** @var $tempoFinal TemposMedio */
                $tempoFinal = $tempoMedio->first();
                $tempoFinal = $tempoFinal->tempo_medio_producao_minutos;
            }
            $newPedido->tempo_producao_aproximado_minutos = $tempoFinal;
            $this->render(false);
            if ($this->Pedidos->save($newPedido)) {
                $newPedido = $this->persistProdutosPedido($newPedido);
                if ($this->Pedidos->save($newPedido)) {
                    $this->calcularEntrega($endereco, $newPedido);
                } else {
                    throw new \Exception('Erro ao cadastrar pedido');
                }
            } else {
                throw new \Exception('Erro ao cadastrar pedido');
            }
            $this->Pedidos->getConnection()->commit();
            $success = true;
        } catch (\Exception $exception) {
            $success = false;
            $msg = $exception->getMessage();
            $this->Pedidos->getConnection()->rollback();
        }

        echo json_encode(['success' => $success, 'pedido' => $newPedido->id, 'message' => $msg]);
    }

    public function rejeitarPedidoAberto()
    {
        $this->render(false);
        $success = false;
        if ($this->forceAlterarSituacao(Pedido::STATUS_CANCELADO_CLIENTE)) {
            $success = true;
        }
        echo json_encode(['success' => $success]);
    }

    public function confirmarPedidoAberto($formaPagamento = null)
    {
        $this->render(false);
        try {
            $this->Pedidos->getConnection()->begin();
            $success = $this->forceAlterarSituacao(Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA);
            if ($success) {
                /** @var $pedido Pedido */
                $this->getPedidoSession()->formas_pagamento_id = intval($formaPagamento);
                if ($this->Pedidos->save($this->getPedidoSession())) {
                    $this->Pedidos->getConnection()->commit();
                    $msg = 'Sucesso';
                } else {
                    throw new Exception('Não foi possível vincular forma de pagamento ao pedido, se o problema persistir comunique a empresa');
                }
            } else {
                throw new Exception('Não foi possível alterar a situação do pedido, se o problema persistir comunique a empresa');
            }
        } catch (Exception $exception) {
            $success = false;
            $msg = $exception->getMessage();
            $this->Pedidos->getConnection()->rollback();
        }
        echo json_encode(['success' => $success, 'message' => $msg]);
    }

    private function forceAlterarSituacao($situacao)
    {
        $tableLocator = new TableLocator();
        /** @var $tablePedidos PedidosTable */
        $tablePedidos = $tableLocator->get('Pedidos');
        $validator = new SiteUtilsPedido();
        /** @var $pedido Pedido */
        $pedido = $validator->existsPedidoEmAberto($this->Auth->user('id'), true);
        if ($pedido) {
            $this->setPedidoSession($pedido);
            $pedido->status_pedido = $situacao;
            if ($tablePedidos->save($pedido)) {
                return true;
            }
        }
        return false;
    }

    public function saveTrocoPara($trocoPara)
    {
        $this->render(false);
        $success = false;
        $validator = new SiteUtilsPedido();
        /** @var $pedido Pedido */
        $pedido = $validator->existsPedidoEmAberto($this->Auth->user('id'), true);
        $pedido->troco_para = floatval($trocoPara);
        if ($this->Pedidos->save($pedido)) {
            $success = true;
        }
        echo json_encode(['success' => $success]);
    }

    public function calcularAcrescimo($formaPagamentoId)
    {
        $this->render(false);
        $success = false;
        $reload = true;
        $tableLocator = new TableLocator();
        $validator = new SiteUtilsPedido();
        $formaPagamentoTable = $tableLocator->get('FormasPagamentos');
        /** @var $formaPagamento FormasPagamento */
        $formaPagamento = $formaPagamentoTable->find()->where(['id' => $formaPagamentoId])->first();
        if ($formaPagamento) {
            /** @var $pedido Pedido */
            $pedido = $validator->existsPedidoEmAberto($this->Auth->user('id'), true);
            $pedido->formas_pagamento_id = $formaPagamento->id;

            if ($formaPagamento->aumenta_valor) {
                $acrescimo = $pedido->valor_produtos * ($formaPagamento->aumenta_valor / 100);
                $pedido->valor_acrescimo = $acrescimo;
            } else {
                $pedido->valor_acrescimo = 0;
            }
            if (!$formaPagamento->necessita_troco) {
                $pedido->troco_para = 0;
            }
            if ($this->Pedidos->save($pedido)) {
                $success = true;
                $reload = true;
            }
            if (!$formaPagamento->aumenta_valor) {
                $reload = false;
            }
        } else {
            $success = false;
            $reload = true;
        }
        echo json_encode(['success' => $success, 'reload' => $reload]);
    }

    public function aplicarCupom($cupom = null)
    {
        $tableLocator = new TableLocator();
        $validator = new SiteUtilsPedido();
        $this->render(false);
        $success = false;
        /** @var $pedido Pedido */
        $pedido = $validator->existsPedidoEmAberto($this->Auth->user('id'), true);
        if ($cupom) {
            $cupom = strtoupper($cupom);
            /** @var $cupomModel CupomSite */
            $cupomTable = $tableLocator->get('CupomSite');
            $cupomModel = $cupomTable->find()->where(['nome_cupom' => $cupom, 'maximo_vezes_usar' => 0, 'empresa_id' => $pedido->empresa_id])->first();
            if (!$cupomModel) {
                $cupomModel = $cupomTable->find()->where(['nome_cupom' => $cupom, 'vezes_usado < maximo_vezes_usar', 'empresa_id' => $pedido->empresa_id])->first();
            }
            if ($cupomModel) {
                $cupomModel->vezes_usado++;
                if ($pedido) {
                    $valorDesconto = 0;
                    if ($cupomModel->porcentagem) {
                        $valorDesconto = $pedido->valor_total_cobrado * ($cupomModel->valor_desconto / 100);
                    } else {
                        $valorDesconto = $cupomModel->valor_desconto;
                    }
                    if ($valorDesconto > 0) {
                        $pedido->valor_desconto = $valorDesconto;
                        $pedido->cupom_usado = $cupom;
                        if ($this->Pedidos->save($pedido)) {
                            $success = true;
                            $cupomTable->save($cupomModel);
                        } else {
                            $success = false;
                        }
                    }
                } else {
                    $success = false;
                }
            } else {
                $success = false;
            }
        }
        echo json_encode(['success' => $success]);
    }

    public function meusPedidos()
    {
        $filtrosEmAndamento = [
             ['user_id' => $this->empresaUtils->getUserId()],
             ['status_pedido not in' => [Pedido::STATUS_ENTREGUE, Pedido::STATUS_CANCELADO_CLIENTE, Pedido::STATUS_REJEITADO]]
        ];
        $filtrosHistorico = [
            ['user_id' => $this->empresaUtils->getUserId()],
            ['status_pedido in' => [Pedido::STATUS_ENTREGUE, Pedido::STATUS_REJEITADO]]
        ];
        $pedidos = $this->Pedidos->find()->where($filtrosEmAndamento)->orderDesc('id');
        $pedidosHistorico = $this->Pedidos->find()->where($filtrosHistorico)->orderDesc('id')->count();
        $this->set(compact('pedidos', 'pedidosHistorico'));
    }

    public function meusPedidosHistorico()
    {
        $filtrosHistorico = [
            ['user_id' => $this->empresaUtils->getUserId()],
            ['status_pedido in' => [Pedido::STATUS_ENTREGUE, Pedido::STATUS_REJEITADO]]
        ];
        $pedidos = $this->Pedidos->find()->where($filtrosHistorico)->orderDesc('id');
        $this->set(compact('pedidos'));
    }



    public function verStatus($id = null)
    {
        $pedido = $this->Pedidos->get($id);
        if ($pedido->user_id !== $this->empresaUtils->getUserId()) {
            $this->Flash->error(__('O pedido informado não pertence ao seu usuário.'));
            return $this->redirect(['action' => 'meusPedidos']);
        }
        $this->set(compact('pedido'));
    }

    public function view($id = null)
    {
        $pedido = $this->Pedidos->get($id);
        if ($pedido->tipo_pedido == Pedido::TIPO_PEDIDO_DELIVERY) {
            $pedido->user = $this->getTableLocator()->get('Users')->find()->where(['id' => $pedido->user_id])->first();
        }
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
