<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\TemposMedio;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * TemposMedios Controller
 *
 * @property \App\Model\Table\TemposMediosTable $TemposMedios
 *
 * @method \App\Model\Entity\TemposMedio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TemposMediosController extends AppController
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
        $temposMedios = $this->paginate($this->TemposMedios->find()->where($this->generateConditionsFind()));

        $this->set(compact('temposMedios'));
    }

    /**
     * View method
     *
     * @param string|null $id Tempos Medio id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $temposMedio = $this->TemposMedios->get($id, [
            'contain' => ['Empresas']
        ]);

        $this->set('temposMedio', $temposMedio);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $temposMedio = $this->TemposMedios->newEntity();
        if ($this->request->is('post')) {
            $temposMedio = $this->TemposMedios->patchEntity($temposMedio, $this->request->getData());
            $temposMedio->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->TemposMedios->save($temposMedio)) {
                $this->Flash->success(__('Salvo com sucesso.'));
                if($temposMedio->ativo){
                    $this->desativaTempoMedioAtivo($temposMedio->tipo, $temposMedio->id);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $this->set(compact('temposMedio'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tempos Medio id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $temposMedio = $this->TemposMedios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $temposMedio = $this->TemposMedios->patchEntity($temposMedio, $this->request->getData());
            $temposMedio->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->TemposMedios->save($temposMedio)) {
                $this->Flash->success(__('Editado com sucesso.'));
                if($temposMedio->ativo){
                    $this->desativaTempoMedioAtivo($temposMedio->tipo,  $temposMedio->id);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $this->set(compact('temposMedio'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tempos Medio id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $temposMedio = $this->TemposMedios->get($id);
        if ($this->TemposMedios->delete($temposMedio)) {
            $this->Flash->success(__('The tempos medio has been deleted.'));
        } else {
            $this->Flash->error(__('The tempos medio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function desativaTempoMedioAtivo($tipo, $atual){
        /** @var $temposMedios TemposMedio*/
        $temposMedios = $this->getTableLocator()->get('TemposMedios')->find()->where(['empresa_id' => $this->empresaUtils->getUserEmpresaId(), 'tipo' => $tipo, 'ativo' => true , 'id <>' => $atual])->first();
        if($temposMedios){
            $temposMedios->ativo = false;
            $this->TemposMedios->save($temposMedios);
        }
    }
}
