<?php


namespace App\Controller;

use App\Model\Entity\Pedido;
use App\Model\Entity\PedidosProduto;
use App\Model\Entity\Produto;
use App\Model\Entity\User;
use App\Model\Table\PedidosProdutosTable;
use App\Model\Table\PedidosTable;

/**
 * Classe para requisições API do aplicativo laComanda
 */
class ComandasController extends BaseApiController
{

    /**
     * Permite o acesso as funcoes
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow([
            'login',
            'allComandas',
            'allCategorias',
            'getItens',
            'getListasAdicionais',
            'fechar',
            'nova',
            'getItensComanda',
            'cancelarProducao',
            'addProdutoComanda',
            'opcionaisItem',
        ]);
    }

    public function login()
    {
        /** @var $user User */
        $user = $this->Auth->identify();
        $success = false;
        $token = false;
        $nome = false;
        if ($user && $user['tipo'] != User::TIPO_CLIENTE) {
            $success = true;
            $token = $user['token'];
            $nome = $user['nome_completo'];
        }
        $return = [
            'success' => $success,
            'token' => $token,
            'user' => $nome,
        ];
        $this->callReturn($return);
    }

    public function allComandas()
    {
        $comandas = $this->getTableLocator()->get('Pedidos')->find()->where(['tipo_pedido' => Pedido::TIPO_PEDIDO_COMANDA, 'status_pedido' => Pedido::STATUS_ABERTA]);
        $comandasFormat = [];
        $situacaoList = Pedido::getComandaStatusList();
        foreach ($comandas as $comanda) {
            $comandasFormat[] = [
                'id' => $comanda->id,
                'cliente' => $comanda->cliente,
                'situacao' => $situacaoList[$comanda->status_pedido],
                'valor' => $comanda->getValorTotal()
            ];
        }
        $return = [
            'comandas' => $comandasFormat,
        ];
        $this->callReturn($return);
    }

    public function allCategorias()
    {
        $categorias = $this->getTableLocator()->get('CategoriasProdutos')->find()->all();
        $categoriaFormat = [];
        foreach ($categorias as $categoria) {
            $categoriaFormat[] = [
                'id' => $categoria->id,
                'nome' => $categoria->nome_categoria,
            ];
        }
        $return = [
            'categorias' => $categoriaFormat,
        ];
        $this->callReturn($return);
    }

    public function getItens()
    {
        $categoria = $this->getRequest()->getData('categoria');
        $itens = $this->getTableLocator()->get('Produtos')->find()->where(['categorias_produto_id' => $categoria, 'ativo_produto' => true]);
        $itensFormat = [];
        foreach ($itens as $item) {
            $itensFormat[] = [
                'id' => $item->id,
                'nome' => $item->nome_produto,
                'preco' => $item->preco_produto,
            ];
        }
        $return = [
            'itens' => $itensFormat,
        ];
        $this->callReturn($return);
    }

    public function getListasAdicionais()
    {
        $produto = $this->getRequest()->getData('item');
        $retorno = ListasController::getListasProduto($produto);
        $this->callReturn($retorno);
    }

    public function fechar()
    {
        $comanda = $this->getRequest()->getData('comanda');
        /** @var $pedidos PedidosTable */
        $pedidos = $this->getTableLocator()->get('Pedidos');
        /** @var  $comandaModel Pedido */
        $comandaModel = $pedidos->find()->where(['id' => $comanda])->first();
        $success = false;
        if ($comandaModel) {
            $comandaModel->status_pedido = Pedido::STATUS_FECHADA;
            if ($pedidos->save($comandaModel)) {
                $success = true;
            }
        }
        $return = [
            'success' => $success,
        ];
        $this->callReturn($return);
    }

    public function nova()
    {
        $success = false;
        $message = null;
        $cliente = $this->getRequest()->getData('cliente');
        $newComanda = new Pedido();
        $newComanda->empresa_id = $this->empresaUtils->getEmpresaBase();
        $newComanda->status_pedido = Pedido::STATUS_ABERTA;
        $newComanda->tipo_pedido = Pedido::TIPO_PEDIDO_COMANDA;
        $newComanda->data_pedido = new \DateTime();
        $newComanda->valor_produtos = 0;
        $newComanda->valor_desconto = 0;
        $newComanda->valor_acrescimo = 0;
        $newComanda->troco_para = 0;
        $newComanda->cliente = $cliente;
        $newComanda->origem = Pedido::ORIGEM_APP_CLIENTE;
        /** @var $pedidos PedidosTable */
        $pedidos = $this->getTableLocator()->get('Pedidos');
        if ($newComanda) {
            if ($pedidos->save($newComanda)) {
                $success = true;
            }
        }
        $return = [
            'success' => $success,
        ];
        $this->callReturn($return);
    }

    public function getItensComanda()
    {
        $comanda = $this->getRequest()->getData('comanda');
        /** @var $pedidosProdutos PedidosProduto[] */
        $pedidosProdutos = $this->getTableLocator()->get('PedidosProdutos')->find()->where(['pedido_id' => $comanda]);
        $formated = [];
        $statusList = PedidosProduto::getAllStatusList();
        foreach ($pedidosProdutos as $pedidoItem) {
            /** @var $produto Produto */
            $produto = $this->getTableLocator()->get('Produtos')->find()->where(['id' => $pedidoItem->produto_id])->first();
            $formated[] = [
                'id' => $pedidoItem->id,
                'produto' => $produto->nome_produto,
                'quantidade' => $pedidoItem->quantidade,
                'observacao' => $pedidoItem->observacao,
                'valor' => $pedidoItem->valor_total_cobrado,
                'status' => $statusList[$pedidoItem->status],
            ];
        }
        $return = [
            'itens' => $formated,
        ];
        $this->callReturn($return);
    }

    public function cancelarProducao()
    {
        $item = $this->getRequest()->getData('item');
        /** @var $pedidoItem PedidosProduto */
        $pedidoItem = $this->getTableLocator()->get("PedidosProdutos")->find()->where(['id' => $item])->first();
        $success = false;
        $message = "Erro ao realizar operação";
        if ($pedidoItem) {
            if ($pedidoItem->status == PedidosProduto::STATUS_EM_FILA_PRODUCAO) {
                $pedidoItem->status = PedidosProduto::STATUS_PRODUCAO_CANCELADA;
                if ($this->getTableLocator()->get("PedidosProdutos")->save($pedidoItem)) {
                    $success = true;
                }
            } else {
                $message = "A situação do item não permite está ação, só se pode cancelar itens que estão na fila para produção.";
            }
        } else {
            $message = "Não localizado item para cancelamento.";
        }
        $return = [
            'success' => $success,
            'message' => $message,
        ];
        $this->callReturn($return);
    }

    public function addProdutoComanda()
    {
        try {
            /** @var $pedidoProduto PedidosProdutosTable*/
            $pedidoProduto = $this->getTableLocator()->get('PedidosProdutos');
            $item = $this->getRequest()->getData('item');
            $comanda = $this->getRequest()->getData('comanda');
            $observacao = $this->getRequest()->getData('observacao');
            $quantidade = $this->getRequest()->getData('quantidade');
            $opcionais = $this->decode($this->getRequest()->getData('opcionais'));
            /** @var $newPedidoProduto PedidosProduto */
            $newPedidoProduto = $pedidoProduto->newEntity();
            $newPedidoProduto->pedido_id = $comanda;
            /** @var $produto Produto */
            $produto = $this->getTableLocator()->get('Produtos')->find()->where(['id' => $item])->first();
            $newPedidoProduto->produto_id = $produto->id;
            $newPedidoProduto->quantidade = $quantidade;
            $newPedidoProduto->observacao = $observacao;
            $itensCarrinhoController = new ItensCarrinhosController();
            $formatedOpcionais = $itensCarrinhoController->formatOpcionais($opcionais);
            $newPedidoProduto->opcionais = $formatedOpcionais['opcionais'];
            $newPedidoProduto->valor_total_cobrado = $itensCarrinhoController->calculaPrecoProduto($produto, $newPedidoProduto->quantidade, $formatedOpcionais['valor']);
            $newPedidoProduto->ambiente_producao_responsavel = $produto->ambiente_producao_responsavel;
            $newPedidoProduto->status = PedidosProduto::STATUS_EM_FILA_PRODUCAO;
            if ($pedidoProduto->save($newPedidoProduto)) {
                $success = true;
            } else {
                $success = false;
            }
        } catch (\Exception $exception) {
            $success = false;
        }

        $return = [
            'success' => $success,
        ];
        $this->callReturn($return);
    }

    public function opcionaisItem(){

    }
}