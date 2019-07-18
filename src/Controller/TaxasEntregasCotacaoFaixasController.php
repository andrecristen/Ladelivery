<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * TaxasEntregasCotacaoFaixas Controller
 *
 * @property \App\Model\Table\TaxasEntregasCotacaoFaixasTable $TaxasEntregasCotacaoFaixas
 *
 * @method \App\Model\Entity\TaxasEntregasCotacaoFaixa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TaxasEntregasCotacaoFaixasController extends AppController
{

    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, $eventManager = null, $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->empresaUtils = new EmpresaUtils();
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
        $taxasEntregasCotacaoFaixas = $this->paginate($this->TaxasEntregasCotacaoFaixas);

        $this->set(compact('taxasEntregasCotacaoFaixas'));
    }

    /**
     * View method
     *
     * @param string|null $id Taxas Entregas Cotacao Faixa id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taxasEntregasCotacaoFaixa = $this->TaxasEntregasCotacaoFaixas->get($id, [
            'contain' => ['Empresas']
        ]);

        $this->set('taxasEntregasCotacaoFaixa', $taxasEntregasCotacaoFaixa);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $taxasEntregasCotacaoFaixa = $this->TaxasEntregasCotacaoFaixas->newEntity();
        if ($this->request->is('post')) {
            $taxasEntregasCotacaoFaixa = $this->TaxasEntregasCotacaoFaixas->patchEntity($taxasEntregasCotacaoFaixa, $this->request->getData());
            $taxasEntregasCotacaoFaixa->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->TaxasEntregasCotacaoFaixas->save($taxasEntregasCotacaoFaixa)) {
                $this->Flash->success(__('Taxa Entrega Faixa Salva.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $this->set(compact('taxasEntregasCotacaoFaixa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Taxas Entregas Cotacao Faixa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxasEntregasCotacaoFaixa = $this->TaxasEntregasCotacaoFaixas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxasEntregasCotacaoFaixa = $this->TaxasEntregasCotacaoFaixas->patchEntity($taxasEntregasCotacaoFaixa, $this->request->getData());
            if ($this->TaxasEntregasCotacaoFaixas->save($taxasEntregasCotacaoFaixa)) {
                $this->Flash->success(__('Taxa Entrega Faixa Salva.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $empresas = $this->TaxasEntregasCotacaoFaixas->Empresas->find('list', ['limit' => 200]);
        $this->set(compact('taxasEntregasCotacaoFaixa', 'empresas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Taxas Entregas Cotacao Faixa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxasEntregasCotacaoFaixa = $this->TaxasEntregasCotacaoFaixas->get($id);
        if ($this->TaxasEntregasCotacaoFaixas->delete($taxasEntregasCotacaoFaixa)) {
            $this->Flash->success(__('The taxas entregas cotacao faixa has been deleted.'));
        } else {
            $this->Flash->error(__('The taxas entregas cotacao faixa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
