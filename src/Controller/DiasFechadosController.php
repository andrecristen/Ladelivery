<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * DiasFechados Controller
 *
 * @property \App\Model\Table\DiasFechadosTable $DiasFechados
 *
 * @method \App\Model\Entity\DiasFechado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DiasFechadosController extends AppController
{
    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->empresaUtils = new EmpresaUtils();
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
        $diasFechados = $this->paginate($this->DiasFechados->find()->where($this->generateConditionsFind()));
        $this->set(compact('diasFechados'));
    }

    /**
     * View method
     *
     * @param string|null $id Dias Fechado id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diasFechado = $this->DiasFechados->get($id, [
            'contain' => []
        ]);

        $this->set('diasFechado', $diasFechado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $diasFechado = $this->DiasFechados->newEntity();
        if ($this->request->is('post')) {
            $diasFechado = $this->DiasFechados->patchEntity($diasFechado, $this->request->getData());
            $diasFechado->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->DiasFechados->save($diasFechado)) {
                $this->Flash->success(__('Dia Fechado salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $this->set(compact('diasFechado'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dias Fechado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diasFechado = $this->DiasFechados->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diasFechado = $this->DiasFechados->patchEntity($diasFechado, $this->request->getData());
            $diasFechado->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->DiasFechados->save($diasFechado)) {
                $this->Flash->success(__('Dia Fechado salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $this->set(compact('diasFechado'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dias Fechado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diasFechado = $this->DiasFechados->get($id);
        if ($this->DiasFechados->delete($diasFechado)) {
            $this->Flash->success(__('Dia Fechado excluido com sucesso.'));
        } else {
            $this->Flash->error(__('Erro, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
