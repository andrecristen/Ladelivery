<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Endereco;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * Enderecos Controller
 *
 * @property \App\Model\Table\EnderecosTable $Enderecos
 *
 * @method \App\Model\Entity\Endereco[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnderecosController extends AppController
{
    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->setPublicAction('meusEnderecos');
        $this->setPublicAction('addEnderecoCliente');
        $this->setPublicAction('excluirEnderecoCliente');
        $this->setPublicAction('editarEnderecoCliente');
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
        $enderecos = $this->paginate($this->Enderecos->find()->where($this->generateConditionsFind(false)));

        $this->set(compact('enderecos'));
    }

    /**
     * View method
     *
     * @param string|null $id Endereco id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $endereco = $this->Enderecos->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('endereco', $endereco);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $endereco = $this->Enderecos->newEntity();
        if ($this->request->is('post')) {
            $endereco = $this->Enderecos->patchEntity($endereco, $this->request->getData());
            if ($this->Enderecos->save($endereco)) {
                $this->Flash->success(__('Endereço salvo.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar endereço, tente novamente.'));
        }
        $users = $this->Enderecos->Users->find('list');
        $this->set(compact('endereco', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Endereco id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $endereco = $this->Enderecos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $endereco = $this->Enderecos->patchEntity($endereco, $this->request->getData());
            if ($this->Enderecos->save($endereco)) {
                $this->Flash->success(__('Endereço salvo.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar endereço, tente novamente.'));
        }
        $users = $this->Enderecos->Users->find('list');
        $this->set(compact('endereco', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Endereco id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $endereco = $this->Enderecos->get($id);
        if ($this->Enderecos->delete($endereco)) {
            $this->Flash->success(__('Endereço excluído.'));
        } else {
            $this->Flash->error(__('Erro ao excluir endereço, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function meusEnderecos($id = null){
        $enderecos = $this->Enderecos->find()->where(['user_id'=>$this->Auth->user('id')]);
        $this->set('enderecos', $enderecos);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $endereco = $this->Enderecos->get($id, [
                'contain' => []
            ]);
            if($endereco->user_id != $this->Auth->user('id')){
                $this->Flash->error(__('O endereço qual você tentou editar não está relacionado com seu usuário, então você não pode altera-lo.'));
                return $this->redirect(['action' => 'meusEnderecos']);
            }
            $endereco->tipo_endereco = Endereco::TIPO_ENDERECO_CLIENTE;
            $endereco = $this->Enderecos->patchEntity($endereco, $this->request->getData());
            if ($this->Enderecos->save($endereco)) {
                $this->Flash->success(__('Endereco salvo.'));
                return $this->redirect(['action' => 'meusEnderecos']);
            }
            $this->Flash->error(__('Tente novamente.'));
        }
    }

    public function addEnderecoCliente(){
        $endereco = $this->Enderecos->newEntity();
        if ($this->request->is('post')) {
            $endereco = $this->Enderecos->patchEntity($endereco, $this->request->getData());
            $endereco->user_id = $this->Auth->user('id');
            $endereco->tipo_endereco = Endereco::TIPO_ENDERECO_CLIENTE;
            if ($this->Enderecos->save($endereco)) {
                $this->Flash->success(__('Endereco salvo.'));

                return $this->redirect(['action' => 'meusEnderecos']);
            }
            $this->Flash->error(__('Erro ao adicionar endereco, tente novamente'));
        }
        $this->set(compact('endereco', 'users'));
    }

    public function excluirEnderecoCliente($id = null){
        $this->render(false);
        $endereco = $this->Enderecos->get($id);
        if($endereco->user_id == $this->Auth->user('id')){
            if ($this->Enderecos->delete($endereco)) {
                $this->Flash->success(__('Endereco excluído.'));
            } else {
                $this->Flash->error(__('Não foi possivel excluir o endereço, tente novamente.'));
            }
        }else {
            $this->Flash->error(__('Exclusão não autorizada.'));
        }
        return $this->redirect(['action' => 'meusEnderecos']);
    }

    public function editarEnderecoCliente($id = null){
        $endereco = $this->Enderecos->get($id, [
            'contain' => []
        ]);
        if($endereco->user_id == $this->Auth->user('id')){
            if ($this->request->is(['patch', 'post', 'put'])) {
                $endereco = $this->Enderecos->patchEntity($endereco, $this->request->getData());
                if ($this->Enderecos->save($endereco)) {
                    $this->Flash->success(__('Endereço salvo.'));
                    return $this->redirect(['action' => 'meusEnderecos']);
                }
                $this->Flash->error(__('Erro ao salvar endereço, tente novamente.'));
            }
            $this->set(compact('endereco'));
        }else{
            $this->Flash->error(__('Não autorizada edição.'));
            return $this->redirect(['action' => 'meusEnderecos']);
        }
    }
}
