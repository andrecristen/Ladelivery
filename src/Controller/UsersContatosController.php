<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersContatos Controller
 *
 * @property \App\Model\Table\UsersContatosTable $UsersContatos
 *
 * @method \App\Model\Entity\UsersContato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersContatosController extends AppController
{

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
        $usersContatos = $this->paginate($this->UsersContatos);

        $this->set(compact('usersContatos'));
    }

    /**
     * View method
     *
     * @param string|null $id Users Contato id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersContato = $this->UsersContatos->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('usersContato', $usersContato);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersContato = $this->UsersContatos->newEntity();
        if ($this->request->is('post')) {
            $usersContato = $this->UsersContatos->patchEntity($usersContato, $this->request->getData());
            if ($this->UsersContatos->save($usersContato)) {
                $this->Flash->success(__('The users contato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users contato could not be saved. Please, try again.'));
        }
        $users = $this->UsersContatos->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersContato', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Contato id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersContato = $this->UsersContatos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersContato = $this->UsersContatos->patchEntity($usersContato, $this->request->getData());
            if ($this->UsersContatos->save($usersContato)) {
                $this->Flash->success(__('The users contato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users contato could not be saved. Please, try again.'));
        }
        $users = $this->UsersContatos->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersContato', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Contato id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersContato = $this->UsersContatos->get($id);
        if ($this->UsersContatos->delete($usersContato)) {
            $this->Flash->success(__('The users contato has been deleted.'));
        } else {
            $this->Flash->error(__('The users contato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
