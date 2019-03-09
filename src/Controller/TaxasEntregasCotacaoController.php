<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * TaxasEntregasCotacao Controller
 *
 * @property \App\Model\Table\TaxasEntregasCotacaoTable $TaxasEntregasCotacao
 *
 * @method \App\Model\Entity\TaxasEntregasCotacao[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TaxasEntregasCotacaoController extends AppController
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
        $taxasEntregasCotacao = $this->paginate($this->TaxasEntregasCotacao);

        $this->set(compact('taxasEntregasCotacao'));
    }

    /**
     * View method
     *
     * @param string|null $id Taxas Entregas Cotacao id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taxasEntregasCotacao = $this->TaxasEntregasCotacao->get($id, [
            'contain' => []
        ]);

        $this->set('taxasEntregasCotacao', $taxasEntregasCotacao);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $taxasEntregasCotacao = $this->TaxasEntregasCotacao->newEntity();
        if ($this->request->is('post')) {
            $taxasEntregasCotacao = $this->TaxasEntregasCotacao->patchEntity($taxasEntregasCotacao, $this->request->getData());
            if ($this->TaxasEntregasCotacao->save($taxasEntregasCotacao)) {
                $this->Flash->success(__('The taxas entregas cotacao has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taxas entregas cotacao could not be saved. Please, try again.'));
        }
        $this->set(compact('taxasEntregasCotacao'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Taxas Entregas Cotacao id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxasEntregasCotacao = $this->TaxasEntregasCotacao->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxasEntregasCotacao = $this->TaxasEntregasCotacao->patchEntity($taxasEntregasCotacao, $this->request->getData());
            if ($this->TaxasEntregasCotacao->save($taxasEntregasCotacao)) {
                $this->Flash->success(__('The taxas entregas cotacao has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taxas entregas cotacao could not be saved. Please, try again.'));
        }
        $this->set(compact('taxasEntregasCotacao'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Taxas Entregas Cotacao id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxasEntregasCotacao = $this->TaxasEntregasCotacao->get($id);
        if ($this->TaxasEntregasCotacao->delete($taxasEntregasCotacao)) {
            $this->Flash->success(__('The taxas entregas cotacao has been deleted.'));
        } else {
            $this->Flash->error(__('The taxas entregas cotacao could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
