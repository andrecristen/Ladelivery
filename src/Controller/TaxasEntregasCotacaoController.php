<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Utils\EmpresaUtils;
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
            'contain' => ['Empresas']
        ];

        $taxasEntregasCotacao = $this->paginate($this->TaxasEntregasCotacao->find()->where($this->generateConditionsFind()));

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
            $taxasEntregasCotacao->empresa_id = $this->empresaUtils->getUserEmpresaId();
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
            $taxasEntregasCotacao->empresa_id = $this->empresaUtils->getUserEmpresaId();
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
            $this->Flash->success(__('Excluido com sucesso.'));
        } else {
            $this->Flash->error(__('Erro, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
