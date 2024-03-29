<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * EnderecosEmpresas Controller
 *
 * @property \App\Model\Table\EnderecosEmpresasTable $EnderecosEmpresas
 *
 * @method \App\Model\Entity\EnderecosEmpresa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnderecosEmpresasController extends AppController
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
        $enderecosEmpresas = $this->paginate($this->EnderecosEmpresas->find()->where($this->generateConditionsFind(false)));

        $this->set(compact('enderecosEmpresas'));
    }

    /**
     * View method
     *
     * @param string|null $id Enderecos Empresa id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enderecosEmpresa = $this->EnderecosEmpresas->get($id, [
            'contain' => ['Empresas']
        ]);

        $this->set('enderecosEmpresa', $enderecosEmpresa);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $enderecosEmpresa = $this->EnderecosEmpresas->newEntity();
        if ($this->request->is('post')) {
            $enderecosEmpresa = $this->EnderecosEmpresas->patchEntity($enderecosEmpresa, $this->request->getData());
            if ($this->EnderecosEmpresas->save($enderecosEmpresa)) {
                $this->Flash->success(__('The enderecos empresa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enderecos empresa could not be saved. Please, try again.'));
        }
        $empresas = $this->EnderecosEmpresas->Empresas->find('list', ['limit' => 200]);
        $this->set(compact('enderecosEmpresa', 'empresas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Enderecos Empresa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enderecosEmpresa = $this->EnderecosEmpresas->get($id, [
            'contain' => ['Empresas']
        ]);
        $empresaUtils = new EmpresaUtils();
        if($enderecosEmpresa->empresa->id != $empresaUtils->getUserEmpresaId() && $empresaUtils->getUserTipo() !== User::TIPO_MASTER){
            $this->Flash->error(__('Você não pode editar endereços desta empresa, você só pode editar os referentes a sua empresa.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enderecosEmpresa = $this->EnderecosEmpresas->patchEntity($enderecosEmpresa, $this->request->getData());
            if ($this->EnderecosEmpresas->save($enderecosEmpresa)) {
                $this->Flash->success(__('The enderecos empresa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enderecos empresa could not be saved. Please, try again.'));
        }
        $empresas = $this->EnderecosEmpresas->Empresas->find('list', ['limit' => 200]);
        $this->set(compact('enderecosEmpresa', 'empresas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Enderecos Empresa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enderecosEmpresa = $this->EnderecosEmpresas->get($id);
        if ($this->EnderecosEmpresas->delete($enderecosEmpresa)) {
            $this->Flash->success(__('The enderecos empresa has been deleted.'));
        } else {
            $this->Flash->error(__('The enderecos empresa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
