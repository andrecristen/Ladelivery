<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\PedidosProduto;
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
    public function cozinha()
    {
        $this->paginate = [
            'contain' => ['Pedidos', 'Produtos']
        ];

        $filtersFixed = [
            0 => ['ambiente_producao_responsavel' => PedidosProduto::RESPONSAVEL_COZINHA],
            1 => ['status <>'=> PedidosProduto::STATUS_PEDIDO_REJEITADO],
            2 => ['status <>'=> PedidosProduto::STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO]
        ];
        $pedidosProdutos = $this->paginate($this->PedidosProdutos->find()->where($this->generateConditionsFind(false, $filtersFixed)))->sortBy('id', SORT_DESC);

        $this->set(compact('pedidosProdutos'));
    }


    public function bar()
    {
        $this->paginate = [
            'contain' => ['Pedidos', 'Produtos']
        ];
        $filtersFixed = [
            0 => ['ambiente_producao_responsavel' => PedidosProduto::RESPONSAVEL_BAR],
            1 => ['status <>'=> PedidosProduto::STATUS_PEDIDO_REJEITADO],
            2 => ['status <>'=> PedidosProduto::STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO]
        ];
        $pedidosProdutos = $this->paginate($this->PedidosProdutos->find()->where($this->generateConditionsFind(false, $filtersFixed)))->sortBy('id', SORT_DESC);
        $this->set(compact('pedidosProdutos'));
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
