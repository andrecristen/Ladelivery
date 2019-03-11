<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * PedidosEntregas Controller
 *
 * @property \App\Model\Table\PedidosEntregasTable $PedidosEntregas
 *
 * @method \App\Model\Entity\PedidosEntrega[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PedidosEntregasController extends AppController
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
            'contain' => ['Pedidos', 'Enderecos']
        ];
        $pedidosEntregas = $this->paginate($this->PedidosEntregas);

        $this->set(compact('pedidosEntregas'));
    }

    /**
     * View method
     *
     * @param string|null $id Pedidos Entrega id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pedidosEntrega = $this->PedidosEntregas->get($id, [
            'contain' => ['Pedidos', 'Enderecos']
        ]);

        $this->set('pedidosEntrega', $pedidosEntrega);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pedidosEntrega = $this->PedidosEntregas->newEntity();
        if ($this->request->is('post')) {
            $pedidosEntrega = $this->PedidosEntregas->patchEntity($pedidosEntrega, $this->request->getData());
            if ($this->PedidosEntregas->save($pedidosEntrega)) {
                $this->Flash->success(__('The pedidos entrega has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pedidos entrega could not be saved. Please, try again.'));
        }
        $pedidos = $this->PedidosEntregas->Pedidos->find('list', ['limit' => 200]);
        $enderecos = $this->PedidosEntregas->Enderecos->find('list', ['limit' => 200]);
        $this->set(compact('pedidosEntrega', 'pedidos', 'enderecos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pedidos Entrega id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pedidosEntrega = $this->PedidosEntregas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pedidosEntrega = $this->PedidosEntregas->patchEntity($pedidosEntrega, $this->request->getData());
            if ($this->PedidosEntregas->save($pedidosEntrega)) {
                $this->Flash->success(__('The pedidos entrega has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pedidos entrega could not be saved. Please, try again.'));
        }
        $pedidos = $this->PedidosEntregas->Pedidos->find('list', ['limit' => 200]);
        $enderecos = $this->PedidosEntregas->Enderecos->find('list', ['limit' => 200]);
        $this->set(compact('pedidosEntrega', 'pedidos', 'enderecos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pedidos Entrega id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pedidosEntrega = $this->PedidosEntregas->get($id);
        if ($this->PedidosEntregas->delete($pedidosEntrega)) {
            $this->Flash->success(__('The pedidos entrega has been deleted.'));
        } else {
            $this->Flash->error(__('The pedidos entrega could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
