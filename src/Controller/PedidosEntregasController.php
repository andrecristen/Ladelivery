<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\FormasPagamento;
use App\Model\Entity\Pedido;
use App\Model\Entity\User;
use App\Model\Utils\EmpresaUtils;
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

    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->empresaUtils = new EmpresaUtils();
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
            'contain' => ['Pedidos', 'Enderecos', 'Users']
        ];
        $filterFixed = ['Pedidos.empresa_id' => $this->empresaUtils->getUserEmpresaId()];
        $pedidosEntregas = $this->paginate($this->PedidosEntregas->find()->where($this->generateConditionsFind(false, $filterFixed)));

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

    public function setEntregador($id = null){
        $pedidosEntrega = $this->PedidosEntregas->get($id, [
            'contain' => ['Pedidos']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pedidosEntrega = $this->PedidosEntregas->patchEntity($pedidosEntrega, $this->request->getData());
            if ($this->PedidosEntregas->save($pedidosEntrega)) {
                $this->Flash->success(__('Entregador definido com sucesso.'));

                return $this->redirect(['controller'=> 'Pedidos','action' => 'entrega']);
            }
            $this->Flash->error(__('Não foi possível definir o entregador.'));
        }
        $pedidos = $this->PedidosEntregas->Pedidos->find('list', ['limit' => 1])->where(['id' => $pedidosEntrega->pedido_id]);
        /** @var $pedidoModel Pedido*/
        $pedidoModel = $this->PedidosEntregas->Pedidos->find()->where(['id' => $pedidosEntrega->pedido_id])->first();
        /** @var $formaPagamento FormasPagamento*/
        $formaPagamento = $this->getTableLocator()->get('FormasPagamentos')->find()->where(['id' => $pedidoModel->formas_pagamento_id])->first();
        $mensagem = "";
        if($formaPagamento->necesista_maquina_cartao){
            $mensagem .= "O entregador deve levar a máquina de cartão, para o cliente realizar o pagamento. ";
        }
        if($formaPagamento->necessita_troco){
            $mensagem .= "O entregador deve levar R$". ($pedidoModel->troco_para - $pedidoModel->getValorTotal())." para troco.";
        }
        $users = $this->PedidosEntregas->Users->find('list')->where(['tipo' => User::TIPO_ENTREGADOR]);
        $this->set(compact('pedidosEntrega', 'pedidos', 'users', 'mensagem'));
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
        $pedidos = $this->PedidosEntregas->Pedidos->find('list');
        $enderecos = $this->PedidosEntregas->Enderecos->find('list');
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
