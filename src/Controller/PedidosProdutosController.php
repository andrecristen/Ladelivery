<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Pedido;
use App\Model\Entity\PedidosProduto;
use App\Model\Entity\Produto;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * PedidosProdutos Controller
 *
 * @property \App\Model\Table\PedidosProdutosTable $PedidosProdutos
 *
 * @method \App\Model\Entity\PedidosProduto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PedidosProdutosController extends AppController
{

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->setPublicAction('addPedidoItem');
        $this->setPublicAction('alterarSituacaoKanban');
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
            'contain' => ['Pedidos', 'Produtos']
        ];
        $pedidosProdutos = $this->paginate($this->PedidosProdutos);

        $this->set(compact('pedidosProdutos'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function cozinha($agruparPorSituacao = false, $title = false)
    {
        $this->paginate = [
            'contain' => ['Pedidos', 'Produtos']
        ];

        $filtersFixed = [
            0 => ['produtos.ambiente_producao_responsavel' => PedidosProduto::RESPONSAVEL_COZINHA],
            1 => ['status <>'=> PedidosProduto::STATUS_PEDIDO_REJEITADO],
            2 => ['status <>'=> PedidosProduto::STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO]
        ];
        $pedidosProdutos = $this->paginate($this->PedidosProdutos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('id', SORT_DESC);
        if ($agruparPorSituacao){
            $pedidosProdutos = $this->agruparPedidosProdutos($pedidosProdutos);
        }
        $this->set(compact('pedidosProdutos','title'));
    }

    private function agruparPedidosProdutos($pedidosProdutos){
        $produtosAgrupados = [];
        foreach ($pedidosProdutos as $pedidoProduto){
            $produtosAgrupados[$pedidoProduto->status][] = $pedidoProduto;
        }
        return $produtosAgrupados;
    }

    public function cozinhaKanban(){
        $this->cozinha(true, 'Cozinha Kanban');
        $this->render('kanban');
    }

    public function bar($agruparPorSituacao = false, $title = false)
    {
        $this->paginate = [
            'contain' => ['Pedidos', 'Produtos']
        ];
        $filtersFixed = [
            0 => ['produtos.ambiente_producao_responsavel' => PedidosProduto::RESPONSAVEL_BAR],
            1 => ['status <>'=> PedidosProduto::STATUS_PEDIDO_REJEITADO],
            2 => ['status <>'=> PedidosProduto::STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO]
        ];
        $pedidosProdutos = $this->paginate($this->PedidosProdutos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('id', SORT_DESC);
        $pedidosProdutos = $this->paginate($this->PedidosProdutos->find()->where($this->generateConditionsFind(true, $filtersFixed)))->sortBy('id', SORT_DESC);
        if ($agruparPorSituacao){
            $pedidosProdutos = $this->agruparPedidosProdutos($pedidosProdutos);
        }
        $this->set(compact('pedidosProdutos','title'));
    }

    public function barKanban(){
        $this->bar(true, 'Bar Kanban');
        $this->render('kanban');
    }

    /**
     * View method
     *
     * @param string|null $id Pedidos Produto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pedidosProduto = $this->PedidosProdutos->get($id, [
            'contain' => ['Pedidos', 'Produtos']
        ]);

        $this->set('pedidosProduto', $pedidosProduto);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pedidosProduto = $this->PedidosProdutos->newEntity();
        if ($this->request->is('post')) {
            $pedidosProduto = $this->PedidosProdutos->patchEntity($pedidosProduto, $this->request->getData());
            if ($this->PedidosProdutos->save($pedidosProduto)) {
                $this->Flash->success(__('The pedidos produto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pedidos produto could not be saved. Please, try again.'));
        }
        $pedidos = $this->PedidosProdutos->Pedidos->find('list', ['limit' => 200]);
        $produtos = $this->PedidosProdutos->Produtos->find('list', ['limit' => 200]);
        $this->set(compact('pedidosProduto', 'pedidos', 'produtos'));
    }

    public function addPedidoItem(){
        $this->render(false);
        $this->PedidosProdutos->getConnection()->begin();
        $itensCarrinhoController = new ItensCarrinhosController();
        $post = $_GET['postProduto'];
        $post = json_decode($post, true);
        /** @var $newPedidoProduto PedidosProduto*/
        $newPedidoProduto = $this->PedidosProdutos->newEntity();
        $newPedidoProduto->pedido_id = $post['pedidoId'];
        /** @var $produto Produto*/
        $produto = $this->getTableLocator()->get('Produtos')->find()->where(['id' => $post['idProduto']])->first();
        $newPedidoProduto->produto_id = $produto->id;
        $newPedidoProduto->quantidade = $post['quantidade'];
        $newPedidoProduto->observacao = $post['observacao'];
        $formatedOpcionais = $itensCarrinhoController->formatOpcionais($post['opcionais']);
        $newPedidoProduto->opcionais = $formatedOpcionais['opcionais'];
        $newPedidoProduto->valor_total_cobrado = $itensCarrinhoController->calculaPrecoProduto($produto, $newPedidoProduto->quantidade ,$formatedOpcionais['valor']);
        $newPedidoProduto->ambiente_producao_responsavel = $produto->ambiente_producao_responsavel;
        $newPedidoProduto->status = PedidosProduto::STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO;
        if ($this->PedidosProdutos->save($newPedidoProduto)) {
            $success = true;
        }else{
            $success = false;
        }
        $pedidoTable =  $this->getTableLocator()->get('Pedidos');
        /** @var $pedido Pedido*/
        $pedido = $pedidoTable->find()->where(['id' => $newPedidoProduto->pedido_id])->first();
        $pedido->valor_produtos += $newPedidoProduto->valor_total_cobrado;
        if (!$pedidoTable->save($pedido)){
            $success = false;
        }
        if($success){
            $this->PedidosProdutos->getConnection()->commit();
        }else{
            $this->PedidosProdutos->getConnection()->rollback();
        }
        echo json_encode(array("itemGravado" => $success));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pedidos Produto id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pedidosProduto = $this->PedidosProdutos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pedidosProduto = $this->PedidosProdutos->patchEntity($pedidosProduto, $this->request->getData());
            if ($this->PedidosProdutos->save($pedidosProduto)) {
                $this->Flash->success(__('The pedidos produto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pedidos produto could not be saved. Please, try again.'));
        }
        $pedidos = $this->PedidosProdutos->Pedidos->find('list', ['limit' => 200]);
        $produtos = $this->PedidosProdutos->Produtos->find('list', ['limit' => 200]);
        $this->set(compact('pedidosProduto', 'pedidos', 'produtos'));
    }

    public function alterarSituacao($id = null){
        $pedidoProduto = $this->PedidosProdutos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pedidoProduto = $this->PedidosProdutos->patchEntity($pedidoProduto, $this->request->getData());
            if ($this->PedidosProdutos->save($pedidoProduto)) {
                $this->Flash->success(__('Situação Alterada com sucesso.'));
                $this->verificaTodosItensProducaoConcluida();
                if($pedidoProduto->ambiente_producao_responsavel == PedidosProduto::RESPONSAVEL_COZINHA){
                    return $this->redirect(['action' => 'cozinha']);
                }
                return $this->redirect(['action' => 'bar']);
            }
            $this->Flash->error(__('Não foi possível alterar a situação, tente novamente.'));
        }
        $this->set(compact('pedidoProduto'));
    }

    public function alterarSituacaoKanban(){
        $this->render(false);
        $item = $_GET['item'];
        $situacao =  $_GET['situacao'];
        $pedidosProduto = $this->PedidosProdutos->get($item);
        $pedidosProduto->status = str_replace('panel-', '', $situacao);
        if($this->PedidosProdutos->save($pedidosProduto)){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['success' => false]);
        }
    }

    /**
     * Verifica se todos os itens de um pedido estao em producao concluida, pra dai alterar
     * o status do pedido pra producao concluida tambem.
     */
    private function verificaTodosItensProducaoConcluida(){

    }
    /**
     * Delete method
     *
     * @param string|null $id Pedidos Produto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pedidosProduto = $this->PedidosProdutos->get($id);
        if ($this->PedidosProdutos->delete($pedidosProduto)) {
            $this->Flash->success(__('The pedidos produto has been deleted.'));
        } else {
            $this->Flash->error(__('The pedidos produto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
