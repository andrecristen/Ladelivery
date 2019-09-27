<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * Empresas Controller
 *
 * @property \App\Model\Table\EmpresasTable $Empresas
 *
 * @method \App\Model\Entity\Empresa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmpresasController extends AppController
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
        ];
        $empresas = $this->paginate($this->Empresas->find()->where($this->generateConditionsFind(false)));

        $this->set(compact('empresas'));
    }

    /**
     * View method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $empresa = $this->Empresas->get($id, [
            'contain' => ['TemposMedios']
        ]);

        $this->set('empresa', $empresa);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $empresa = $this->Empresas->newEntity();
        if ($this->request->is('post')) {
            $empresa = $this->Empresas->patchEntity($empresa, $this->request->getData());
            $contatos = $this->getRequest()->getData('contatos');
            if($contatos){
                $empresa->contatos = json_encode($contatos);
            }
            if ($this->Empresas->save($empresa)) {
                $this->Flash->success(__('Empresa adicionada com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível adicionar empresa, tente novamente.'));
        }
        $users = $this->Empresas->Users->find('list')->where(['tipo' => User::TIPO_EMPRESA]);
        $this->set(compact('empresa', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $empresa = $this->Empresas->get($id, [
            'contain' => []
        ]);
        $empresaUtils = new EmpresaUtils();
        if($empresa->id != $empresaUtils->getUserEmpresaId() && $empresaUtils->getUserTipo() !== User::TIPO_MASTER){
            $this->Flash->error(__('Você não pode editar esta empresa, você só pode editar a sua empresa.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $empresa = $this->Empresas->patchEntity($empresa, $this->request->getData());
            $contatos = $this->getRequest()->getData('contatos');
            if($contatos){
                $empresa->contatos = json_encode($contatos);
            }
            if ($this->Empresas->save($empresa)) {
                $this->Flash->success(__('Empresa salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao editar empresa, tente novamente.'));
        }
        $users = $this->Empresas->Users->find('list')->where(['tipo' => User::TIPO_EMPRESA]);
        $this->set(compact('empresa', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $empresa = $this->Empresas->get($id);
        if ($this->Empresas->delete($empresa)) {
            $this->Flash->success(__('Empresa excluida com sucesso.'));
        } else {
            $this->Flash->error(__('Não foi possível excluir a empresa, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
