<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * HorariosAtendimentos Controller
 *
 * @property \App\Model\Table\HorariosAtendimentosTable $HorariosAtendimentos
 *
 * @method \App\Model\Entity\HorariosAtendimento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HorariosAtendimentosController extends AppController
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
        $horariosAtendimentos = $this->paginate($this->HorariosAtendimentos->find()->where($this->generateConditionsFind()));

        $this->set(compact('horariosAtendimentos'));
    }

    /**
     * View method
     *
     * @param string|null $id Horarios Atendimento id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horariosAtendimento = $this->HorariosAtendimentos->get($id, [
            'contain' => ['Empresas']
        ]);

        $this->set('horariosAtendimento', $horariosAtendimento);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horariosAtendimento = $this->HorariosAtendimentos->newEntity();
        if ($this->request->is('post')) {
            $horariosAtendimento = $this->HorariosAtendimentos->patchEntity($horariosAtendimento, $this->request->getData());
            $horariosAtendimento->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->HorariosAtendimentos->save($horariosAtendimento)) {
                $this->Flash->success(__('Hora Atendimento salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $this->set(compact('horariosAtendimento'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Horarios Atendimento id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horariosAtendimento = $this->HorariosAtendimentos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horariosAtendimento = $this->HorariosAtendimentos->patchEntity($horariosAtendimento, $this->request->getData());
            $horariosAtendimento->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->HorariosAtendimentos->save($horariosAtendimento)) {
                $this->Flash->success(__('Hora Atendimento salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $this->set(compact('horariosAtendimento'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Horarios Atendimento id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horariosAtendimento = $this->HorariosAtendimentos->get($id);
        if ($this->HorariosAtendimentos->delete($horariosAtendimento)) {
            $this->Flash->success(__('Excluido com sucesso.'));
        } else {
            $this->Flash->error(__('Erro, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
