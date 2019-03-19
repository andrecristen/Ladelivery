<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->pertmiteAction('login');
        $this->pertmiteAction('profile', $this->Auth->user('id'));
        $this->validateActions();
        $this->empresaUtils = new EmpresaUtils();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users->find()->where(['empresa_id' => $this->empresaUtils->getEmpresaBase()]));
        if($this->empresaUtils->isEmpresaSoftware()){
            $users = $this->paginate($this->Users);
        }
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    public function profile($id = null){
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário editado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possivel editar usuário, tente novamente.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->empresa_id = $this->empresaUtils->getEmpresaBase();
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário adicionado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível adicionar um novo usuário, tente novamente!'));
        }
        $list = User::getTipoListCRUD();
        if($this->empresaUtils->isEmpresaSoftware()){
            $list = User::getTipoListAll();
        }
        $this->set(compact('user', 'list'));
    }

    public function registrar()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->tipo = User::TIPO_CLIENTE;
            $user->empresa_id = $this->empresaUtils->getEmpresaSoftware();
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário adicionado com sucesso.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Não foi possível adicionar um novo usuário aconteceu um probleminha!'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário editado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possivel editar usuário, tente novamente.'));
        }
        $list = User::getTipoListCRUD();
        if($this->empresaUtils->isEmpresaSoftware()){
            $list = User::getTipoListAll();
        }
        $this->set(compact('user', 'list'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Usuário excluido com sucesso.'));
        } else {
            $this->Flash->error(__('Não foi possivel excluir usuário, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if($user['tipo'] == User::TIPO_EMPRESA){
                    $this->Flash->default(__('Usuario do tipo empresa, nao serve para login e acesso ao sistema apenas para configuracoes internas do sistema!'), ['class'=>'"alert alert-danger']);
                    return;
                }
                $this->Auth->setUser($user);
                $redirect = ($this->Auth->redirectUrl());
                //Quer dizer que é um admin entrando a primeira vez
                if($user['tipo'] == User::TIPO_ADMINISTRADOR){
                    if($redirect == '/pages'){
                        return $this->redirect('/users');
                    }
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->default(__('Login ou Senha incorretos!'), ['class'=>'"alert alert-danger']);
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

}
