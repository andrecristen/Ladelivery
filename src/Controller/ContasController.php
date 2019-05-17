<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * Contas Controller
 *
 * @property \App\Model\Table\ContasTable $Contas
 *
 * @method \App\Model\Entity\Conta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContasController extends AppController
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
            'contain' => ['Users']
        ];
        $contas = $this->paginate($this->Contas);

        $this->set(compact('contas'));
    }

    /**
     * View method
     *
     * @param string|null $id Conta id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $conta = $this->Contas->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('conta', $conta);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $conta = $this->Contas->newEntity();
        if ($this->request->is('post')) {
            $conta = $this->Contas->patchEntity($conta, $this->request->getData());
            $conta->data_pagamento = null;
            if ($this->Contas->save($conta)) {
                $this->Flash->success(__('Conta salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível salvar a conta, tente novamente.'));
        }
        $users = $this->Contas->Users->find('list');
        $this->set(compact('conta', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Conta id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $conta = $this->Contas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $conta = $this->Contas->patchEntity($conta, $this->request->getData());
            if ($this->Contas->save($conta)) {
                $this->Flash->success(__('Conta salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível salvar a conta, tente novamente.'));
        }
        $users = $this->Contas->Users->find('list');
        $this->set(compact('conta', 'users'));
    }

    public function definirPago($id = null){
        $conta = $this->Contas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $conta->data_pagamento = $this->getRequest()->getData('data_pagamento', new \DateTime());
            if ($this->Contas->save($conta)) {
                $this->Flash->success(__('Conta salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível salvar a conta, tente novamente.'));
        }
        $this->set(compact('conta', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Conta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $conta = $this->Contas->get($id);
        if ($this->Contas->delete($conta)) {
            $this->Flash->success(__('Conta deletada.'));
        } else {
            $this->Flash->error(__('Não foi possível excluir a conta, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
