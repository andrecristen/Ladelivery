<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * PerfilsUsers Controller
 *
 * @property \App\Model\Table\PerfilsUsersTable $PerfilsUsers
 *
 * @method \App\Model\Entity\PerfilsUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PerfilsUsersController extends AppController
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
            'contain' => ['Perfils', 'Users']
        ];
        $perfilsUsers = $this->paginate($this->PerfilsUsers);

        $this->set(compact('perfilsUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Perfils User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $perfilsUser = $this->PerfilsUsers->get($id, [
            'contain' => ['Perfils', 'Users']
        ]);

        $this->set('perfilsUser', $perfilsUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $perfilsUser = $this->PerfilsUsers->newEntity();
        if ($this->request->is('post')) {
            $perfilsUser = $this->PerfilsUsers->patchEntity($perfilsUser, $this->request->getData());
            if ($this->PerfilsUsers->save($perfilsUser)) {
                $this->Flash->success(__('The perfils user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The perfils user could not be saved. Please, try again.'));
        }
        $perfils = $this->PerfilsUsers->Perfils->find('list', ['limit' => 200]);
        $users = $this->PerfilsUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('perfilsUser', 'perfils', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Perfils User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $perfilsUser = $this->PerfilsUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $perfilsUser = $this->PerfilsUsers->patchEntity($perfilsUser, $this->request->getData());
            if ($this->PerfilsUsers->save($perfilsUser)) {
                $this->Flash->success(__('The perfils user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The perfils user could not be saved. Please, try again.'));
        }
        $perfils = $this->PerfilsUsers->Perfils->find('list', ['limit' => 200]);
        $users = $this->PerfilsUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('perfilsUser', 'perfils', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Perfils User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $perfilsUser = $this->PerfilsUsers->get($id);
        if ($this->PerfilsUsers->delete($perfilsUser)) {
            $this->Flash->success(__('The perfils user has been deleted.'));
        } else {
            $this->Flash->error(__('The perfils user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
