<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Perfil;
use App\Model\Entity\PerfilsUser;
use App\Model\Entity\User;
use App\Model\Table\PerfilsTable;
use App\Model\Utils\EmpresaUtils;
use Cake\Controller\ComponentRegistry;
use Cake\Datasource\ConnectionManager;
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
        $this->setPublicAction('login');
        $this->setPublicAction('alterarSenha');
        $this->setPublicAction('profile');
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
        $filterFixed = ['tipo <>' => User::TIPO_CLIENTE];
        $users = $this->paginate($this->Users->find()->where($this->generateConditionsFind(true, $filterFixed)));
        $this->set(compact('users'));
    }

    public function clientes()
    {
        $filterCliente = ['tipo' => User::TIPO_CLIENTE];
        $users = $this->paginate($this->Users->find()->where($this->generateConditionsFind(false, $filterCliente)));
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
        $contatos = $this->getTableLocator()->get('UsersContatos')->find()->where(['user_id' => $user->id]);
        $enderecos = $this->getTableLocator()->get('Enderecos')->find()->where(['user_id' => $user->id]);
        $this->set(compact('user','contatos', 'enderecos'));
    }

    public function profile(){
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário editado com sucesso.'));
                return $this->redirect(['action' => 'profile']);
            }
            $this->Flash->error(__('Não foi possivel editar usuário, tente novamente.'));
        }
        $this->set(compact('user'));
    }

    public function alterarSenha(){
        $user = $this->Users->get($this->empresaUtils->getUserId(), [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Senha alterada com sucesso.'));
                return $this->redirect(['action' => 'profile', $user->id]);
            }
            $this->Flash->error(__('Não foi possivel alterar a senha, tente novamente.'));
        }
        //Para nao vir com o input preenchido
        $user->password = null;
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
                /** @var $perilsIniciaisTable PerfilsTable*/
                $perilsIniciaisTable = $this->getTableLocator()->get('Perfils');
                /** @var $perilsIniciais Perfil[]*/
                $perilsIniciais = $perilsIniciaisTable->find()->where(['padrao_novos_users' => true]);
                foreach ($perilsIniciais as $perfilInicial){
                    $userPerfil = new PerfilsUser();
                    $userPerfil->user_id = $user->id;
                    $userPerfil->perfil_id = $perfilInicial->id;
                    $this->getTableLocator()->get('PerfilsUsers')->save($userPerfil);
                }
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
        if($user->tipo == User::TIPO_CLIENTE){
            $this->Flash->error(__('Você não pode editar usuários do tipo cliente.'));
            return $this->redirect($this->referer());
        }
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
        if($user->tipo == User::TIPO_CLIENTE){
            $this->Flash->error(__('Você não pode excluir usuários do tipo cliente.'));
            return $this->redirect($this->referer());
        }
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
            /** @var $user User*/
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $_SESSION["empresa"] = $this->Auth->user('empresa_id');
                $redirect = ($this->Auth->redirectUrl());
                //Quer dizer que é um admin entrando a primeira vez
                if($user['tipo'] == User::TIPO_ADMINISTRADOR || $user['tipo'] == User::TIPO_MASTER || $user['tipo'] == User::TIPO_ENTREGADOR ){
                    $_SESSION["menus"] = $this->getMenusToUser($user);
                    if($redirect == '/pages'){
                        return $this->redirect('/financeiro/painel');
                    }
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->default(__('Login ou Senha incorretos!'), ['class'=>'"alert alert-danger']);
            }
        }
    }

    private function getMenusToUser($user){
        $connection = ConnectionManager::get('default');
        if($user['tipo'] == User::TIPO_MASTER){
            $sql = "SELECT * 
                      FROM menus 
                      JOIN modulos
                        ON menus.modulo_id = modulos.id
                      JOIN actions
                        ON actions.id = menus.action_id
                      JOIN controllers
                        ON actions.controller_id = controllers.id      
                     WHERE ativo = true 
                       AND ativo_menu = true
                  ORDER BY ordem, ordem_menu ";
            $results = $connection->execute($sql)->fetchAll('assoc');
        }else{
            $sql = "SELECT * 
                      FROM menus 
                      JOIN modulos
                        ON menus.modulo_id = modulos.id
                      JOIN actions
                        ON actions.id = menus.action_id
                      JOIN controllers
                        ON actions.controller_id = controllers.id      
                     WHERE action_id in(SELECT action_id 
                                          FROM perfils_actions
                                          JOIN perfils_users
                                            ON perfils_actions.perfil_id = perfils_users.perfil_id
                                           AND perfils_users.user_id = :usuario)
                                           
                       AND ativo = true 
                       AND ativo_menu = true
                  ORDER BY ordem, ordem_menu ";
            $results = $connection->execute($sql, ['usuario' => $user['id']])->fetchAll('assoc');
        }
        $menus = [];
        foreach ($results as $result){
            if(!isset($menus[$result['nome']])){
                $menus[$result['nome']] = [
                    'nome' => $result['nome'],
                    'icon' => $result['icon_class'],
                ];
            }
            $menus[$result['nome']]['childrens'][] = [
                'nome' => $result['nome_menu'],
                'controller' => $result['nome_controlador'],
                'action' => $result['nome_action'],
            ];
        }
        return $menus;
    }

    public function logout()
    {
        $this->render(false);
        return $this->redirect($this->Auth->logout());
    }

}
