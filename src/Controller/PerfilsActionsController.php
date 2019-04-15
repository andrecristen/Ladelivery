<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * PerfilsActions Controller
 *
 * @property \App\Model\Table\PerfilsActionsTable $PerfilsActions
 *
 * @method \App\Model\Entity\PerfilsAction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PerfilsActionsController extends AppController
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
            'contain' => ['Actions', 'Perfils']
        ];
        $perfilsActions = $this->paginate($this->PerfilsActions->find()->where($this->generateConditionsFind(false)));

        $this->set(compact('perfilsActions'));
    }

    /**
     * View method
     *
     * @param string|null $id Perfils Action id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $perfilsAction = $this->PerfilsActions->get($id, [
            'contain' => ['Actions', 'Perfils']
        ]);

        $this->set('perfilsAction', $perfilsAction);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $perfilsAction = $this->PerfilsActions->newEntity();
        if ($this->request->is('post')) {
            $perfilsAction = $this->PerfilsActions->patchEntity($perfilsAction, $this->request->getData());
            if ($this->PerfilsActions->save($perfilsAction)) {
                $this->Flash->success(__('The perfils action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The perfils action could not be saved. Please, try again.'));
        }
        $actions = $this->PerfilsActions->Actions->find('list', ['limit' => 200]);
        $perfils = $this->PerfilsActions->Perfils->find('list', ['limit' => 200]);
        $this->set(compact('perfilsAction', 'actions', 'perfils'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Perfils Action id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $perfilsAction = $this->PerfilsActions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $perfilsAction = $this->PerfilsActions->patchEntity($perfilsAction, $this->request->getData());
            if ($this->PerfilsActions->save($perfilsAction)) {
                $this->Flash->success(__('The perfils action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The perfils action could not be saved. Please, try again.'));
        }
        $actions = $this->PerfilsActions->Actions->find('list', ['limit' => 200]);
        $perfils = $this->PerfilsActions->Perfils->find('list', ['limit' => 200]);
        $this->set(compact('perfilsAction', 'actions', 'perfils'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Perfils Action id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $perfilsAction = $this->PerfilsActions->get($id);
        if ($this->PerfilsActions->delete($perfilsAction)) {
            $this->Flash->success(__('The perfils action has been deleted.'));
        } else {
            $this->Flash->error(__('The perfils action could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
