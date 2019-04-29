<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Midia;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * Banners Controller
 *
 * @property \App\Model\Table\BannersTable $Banners
 *
 * @method \App\Model\Entity\Banner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BannersController extends AppController
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
            'contain' => ['Midias']
        ];
        $banners = $this->paginate($this->Banners);

        $this->set(compact('banners'));
    }

    /**
     * View method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $banner = $this->Banners->get($id, [
            'contain' => ['Midias']
        ]);

        $this->set('banner', $banner);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $banner = $this->Banners->newEntity();
        if ($this->request->is('post')) {
            $banner = $this->Banners->patchEntity($banner, $this->request->getData());
            if($this->request->getData('uploadfile')){
                $midiaController = new MidiasController();
                $file = $_FILES['uploadfile'];
                if($file['name'] != ""){
                    if(!$this->verificaDimensionsBanner($file)){
                        $this->Flash->error(__('Atenção, para banners forneça uma imagem com tamanaho igual a 1200x400  pixels.'));
                        return;
                    }
                    $midia = $midiaController->newMidiaByUpload($file, Midia::TIPO_BANNER);
                    if(!$midia){
                        $this->Flash->error(__('Erro ao gravar imagem.'));
                        return;
                    }
                    $banner->midia_id = $midia->id;
                }
            }
            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('Banner salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar banner tente novamente.'));
        }
        $this->set(compact('banner'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $banner = $this->Banners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $banner = $this->Banners->patchEntity($banner, $this->request->getData());
            if($this->request->getData('uploadfile')){
                $midiaController = new MidiasController();
                $file = $_FILES['uploadfile'];
                if($file['name'] != ""){
                    if(!$this->verificaDimensionsBanner($file)){
                        $this->Flash->error(__('Atenção, para banners forneça uma imagem com tamanaho igual a 1200x400  pixels.'));
                        return;
                    }
                    $midia = $midiaController->newMidiaByUpload($file, Midia::TIPO_BANNER);
                    if(!$midia){
                        $this->Flash->error(__('Erro ao gravar imagem.'));
                        return;
                    }
                    $banner->midia_id = $midia->id;
                }
            }
            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('Banner salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao salvar banner tente novamente.'));
        }
        $midias = $this->Banners->Midias->find('list', ['limit' => 200]);
        $this->set(compact('banner', 'midias'));
    }

    private function verificaDimensionsBanner($file){
        $fileinfo = @getimagesize ($file["tmp_name"]);
        if($fileinfo[0] < 1200 || $fileinfo[0] > 1200){
            return false;
        }
        if($fileinfo[1] < 400 || $fileinfo[1] > 400){
            return false;
        }
        return true;
    }
    /**
     * Delete method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $banner = $this->Banners->get($id);
        if ($this->Banners->delete($banner)) {
            $this->Flash->success(__('The banner has been deleted.'));
        } else {
            $this->Flash->error(__('The banner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
