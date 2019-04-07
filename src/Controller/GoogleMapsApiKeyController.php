<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * GoogleMapsApiKey Controller
 *
 * @property \App\Model\Table\GoogleMapsApiKeyTable $GoogleMapsApiKey
 *
 * @method \App\Model\Entity\GoogleMapsApiKey[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GoogleMapsApiKeyController extends AppController
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
        $googleMapsApiKey = $this->paginate($this->GoogleMapsApiKey->find()->where($this->generateConditionsFind(false)));

        $this->set(compact('googleMapsApiKey'));
    }

    /**
     * View method
     *
     * @param string|null $id Google Maps Api Key id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $googleMapsApiKey = $this->GoogleMapsApiKey->get($id, [
            'contain' => ['Empresas']
        ]);

        $this->set('googleMapsApiKey', $googleMapsApiKey);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $googleMapsApiKey = $this->GoogleMapsApiKey->newEntity();
        if ($this->request->is('post')) {
            $googleMapsApiKey = $this->GoogleMapsApiKey->patchEntity($googleMapsApiKey, $this->request->getData());
            if ($this->GoogleMapsApiKey->save($googleMapsApiKey)) {
                $this->Flash->success(__('The google maps api key has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The google maps api key could not be saved. Please, try again.'));
        }
        $empresas = $this->GoogleMapsApiKey->Empresas->find('list');
        $this->set(compact('googleMapsApiKey', 'empresas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Google Maps Api Key id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $googleMapsApiKey = $this->GoogleMapsApiKey->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $googleMapsApiKey = $this->GoogleMapsApiKey->patchEntity($googleMapsApiKey, $this->request->getData());
            if ($this->GoogleMapsApiKey->save($googleMapsApiKey)) {
                $this->Flash->success(__('The google maps api key has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The google maps api key could not be saved. Please, try again.'));
        }
        $empresas = $this->GoogleMapsApiKey->Empresas->find('list');
        $this->set(compact('googleMapsApiKey', 'empresas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Google Maps Api Key id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $googleMapsApiKey = $this->GoogleMapsApiKey->get($id);
        if ($this->GoogleMapsApiKey->delete($googleMapsApiKey)) {
            $this->Flash->success(__('The google maps api key has been deleted.'));
        } else {
            $this->Flash->error(__('The google maps api key could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
