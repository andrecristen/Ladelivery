<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * FormasPagamentos Controller
 *
 * @property \App\Model\Table\FormasPagamentosTable $FormasPagamentos
 *
 * @method \App\Model\Entity\FormasPagamento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FormasPagamentosController extends AppController
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
            'contain' => ['Empresas']
        ];
        $formasPagamentos = $this->paginate($this->FormasPagamentos);

        $this->set(compact('formasPagamentos'));
    }

    /**
     * View method
     *
     * @param string|null $id Formas Pagamento id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $formasPagamento = $this->FormasPagamentos->get($id, [
            'contain' => ['Empresas']
        ]);

        $this->set('formasPagamento', $formasPagamento);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $formasPagamento = $this->FormasPagamentos->newEntity();
        if ($this->request->is('post')) {
            $formasPagamento = $this->FormasPagamentos->patchEntity($formasPagamento, $this->request->getData());
            if ($this->FormasPagamentos->save($formasPagamento)) {
                $this->Flash->success(__('The formas pagamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The formas pagamento could not be saved. Please, try again.'));
        }
        $empresas = $this->FormasPagamentos->Empresas->find('list', ['limit' => 200]);
        $this->set(compact('formasPagamento', 'empresas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Formas Pagamento id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $formasPagamento = $this->FormasPagamentos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formasPagamento = $this->FormasPagamentos->patchEntity($formasPagamento, $this->request->getData());
            if ($this->FormasPagamentos->save($formasPagamento)) {
                $this->Flash->success(__('The formas pagamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The formas pagamento could not be saved. Please, try again.'));
        }
        $empresas = $this->FormasPagamentos->Empresas->find('list', ['limit' => 200]);
        $this->set(compact('formasPagamento', 'empresas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Formas Pagamento id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $formasPagamento = $this->FormasPagamentos->get($id);
        if ($this->FormasPagamentos->delete($formasPagamento)) {
            $this->Flash->success(__('The formas pagamento has been deleted.'));
        } else {
            $this->Flash->error(__('The formas pagamento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
