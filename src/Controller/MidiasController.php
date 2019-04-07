<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Midia;
use App\Model\Utils\EmpresaUtils;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\TableLocator;

/**
 * Midias Controller
 *
 * @property \App\Model\Table\MidiasTable $Midias
 *
 * @method \App\Model\Entity\Midia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MidiasController extends AppController
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
        $midias = $this->paginate($this->Midias->find()->where($this->generateConditionsFind()));
        $this->set(compact('midias'));
    }

    /**
     * View method
     *
     * @param string|null $id Midia id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $midia = $this->Midias->get($id, [
            'contain' => []
        ]);

        $this->set('midia', $midia);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $midia = $this->Midias->newEntity();
        if ($this->request->is('post')) {
            $midia = $this->Midias->patchEntity($midia, $this->request->getData());
            $file = $_FILES;
            $file = $file['uploadfile'];
            $path = $this->getPathNewMidia($midia, false, $file);
            if($path){
                $midia->path_midia = $path;
            }else{
                $this->Flash->error(__('Erro ao salvar Midia.'));
                return;
            }
            $midia->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->Midias->save($midia)) {
                $this->Flash->success(__('Midia salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar Midia.'));
        }
        $tipoList = Midia::getTipoListLojaParceira();
        if($this->empresaUtils->isEmpresaSoftware() || $this->empresaUtils->isEmpresaBase()){
            $tipoList = Midia::getTipoList();
        }
        $this->set(compact('midia', 'tipoList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Midia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $midia = $this->Midias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $midia = $this->Midias->patchEntity($midia, $this->request->getData());
            $file = $_FILES;
            $file = $file['uploadfile'];
            $path = $this->getPathNewMidia($midia, true, $file);
            if($path){
                $midia->path_midia = $path;
            }else{
                $this->Flash->error(__('Erro ao salvar Midia.'));
                return;
            }
            $midia->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->Midias->save($midia)) {
                $this->Flash->success(__('Midia salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar Midia.'));
        }
        $tipoList = Midia::getTipoListLojaParceira();
        if($this->empresaUtils->isEmpresaSoftware() || $this->empresaUtils->isEmpresaBase()){
            $tipoList = Midia::getTipoList();
        }
        $this->set(compact('midia', 'tipoList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Midia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $midia = $this->Midias->get($id);
        if ($this->Midias->delete($midia)) {
            //Remove o arquivo
            unlink(WWW_ROOT . 'img'. DS .$midia->path_midia);
            $this->Flash->success(__('Midia excluida com sucesso.'));
        } else {
            $this->Flash->error(__('Erro ao excluir Midia.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function newMidiaByUpload($file, $tipoMidia){
        $midia = new Midia();
        $midia->empresa_id = $this->empresaUtils->getUserEmpresaId();
        $midia->tipo_midia = $tipoMidia;
        $date = new \DateTime();
        $midia->nome_midia = 'upload_'.$date->format('d_m_y_H_m_s').'_'.$file['name'];
        $midia->path_midia = $this->getPathNewMidia($midia, false, $file);
        if($this->Midias->save($midia)){
            return $midia;
        }else{
            return false;
        }
    }

    private function getPathNewMidia(Midia $midia, $isEdit = false, $file){
        $this->render(false);
        try {
            if($isEdit){
                if(!isset($file['name']) || $file['name'] == ''){
                    return $midia->path_midia;
                }
            }
            $tipoMidiaList = Midia::getTipoListUploadPath();
            if ($midia->path_midia !== null) {
                unlink(WWW_ROOT . 'img'. DS .$midia->path_midia);
            }
            move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img' . DS .$tipoMidiaList[$midia->tipo_midia] . DS .  $midia->nome_midia.'_'.$file['name']);
            return $tipoMidiaList[$midia->tipo_midia] .'/'.  $midia->nome_midia.'_'.$file['name'];
        } catch (\Exception $e) {
            $this->Flash->error(__('Não foi possível adicionar imagem ao produto erro recebido: ' . $e->getMessage()));
            return false;
        }
    }

}
