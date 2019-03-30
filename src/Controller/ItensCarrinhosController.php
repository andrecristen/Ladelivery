<?php

namespace App\Controller;

use Cake\Controller\ComponentRegistry;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * ItensCarrinhos Controller
 *
 * @property \App\Model\Table\ItensCarrinhosTable $ItensCarrinhos
 *
 * @method \App\Model\Entity\ItensCarrinho[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItensCarrinhosController extends AppController
{

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->pertmiteAction('addProduto');
        $this->pertmiteAction('removeItemCarrinho');
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
            'contain' => ['Users', 'Produtos']
        ];
        $itensCarrinhos = $this->paginate($this->ItensCarrinhos->find()->where($this->generateConditionsFind(false)));

        $this->set(compact('itensCarrinhos'));
    }

    /**
     * View method
     *
     * @param string|null $id Itens Carrinho id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itensCarrinho = $this->ItensCarrinhos->get($id, [
            'contain' => ['Users', 'Produtos']
        ]);

        $this->set('itensCarrinho', $itensCarrinho);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itensCarrinho = $this->ItensCarrinhos->newEntity();
        if ($this->request->is('post')) {
            $itensCarrinho = $this->ItensCarrinhos->patchEntity($itensCarrinho, $this->request->getData());
            if ($this->ItensCarrinhos->save($itensCarrinho)) {
                $this->Flash->success(__('The itens carrinho has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The itens carrinho could not be saved. Please, try again.'));
        }
        $users = $this->ItensCarrinhos->Users->find('list', ['limit' => 200]);
        $produtos = $this->ItensCarrinhos->Produtos->find('list', ['limit' => 200]);
        $this->set(compact('itensCarrinho', 'users', 'produtos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Itens Carrinho id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itensCarrinho = $this->ItensCarrinhos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itensCarrinho = $this->ItensCarrinhos->patchEntity($itensCarrinho, $this->request->getData());
            if ($this->ItensCarrinhos->save($itensCarrinho)) {
                $this->Flash->success(__('The itens carrinho has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The itens carrinho could not be saved. Please, try again.'));
        }
        $users = $this->ItensCarrinhos->Users->find('list', ['limit' => 200]);
        $produtos = $this->ItensCarrinhos->Produtos->find('list', ['limit' => 200]);
        $this->set(compact('itensCarrinho', 'users', 'produtos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Itens Carrinho id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itensCarrinho = $this->ItensCarrinhos->get($id);
        if ($this->ItensCarrinhos->delete($itensCarrinho)) {
            $this->Flash->success(__('The itens carrinho has been deleted.'));
        } else {
            $this->Flash->error(__('The itens carrinho could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function addProduto()
    {
        $this->render(false);
        $post = $_GET['postProduto'];
        $post = json_decode($post, true);
        $itensCarrinho = $this->ItensCarrinhos->newEntity();
        $itensCarrinho->user_id = $post['userId'];
        $itensCarrinho->produto_id = $post['idProduto'];
        $itensCarrinho->observacao = $post['observacao'];
        $itensCarrinho->quantidades = $post['quantidade'];
        $validOpcionais = [];
        foreach ($post['opcionais'] as $key => $opcional) {
            if ($opcional !== null) {
                $validOpcionais[$key] = $opcional;
            }
        }
        $itensCarrinho->opicionais = json_encode($validOpcionais);
        $itensCarrinho->valor_total_cobrado = $post['valorCobrado'];
        $success = false;
        if ($this->ItensCarrinhos->save($itensCarrinho)) {
            $success = true;
        }
        echo json_encode(array("itemGravado" => $success));
    }

    public function removeItemCarrinho($id = null)
    {
        $this->render(false);
        $itensCarrinho = $this->ItensCarrinhos->get($id);
        $success = false;
        if ($this->ItensCarrinhos->delete($itensCarrinho)) {
            $success = true;
        }
        echo json_encode(array("itemExcluido" => $success));
    }

}