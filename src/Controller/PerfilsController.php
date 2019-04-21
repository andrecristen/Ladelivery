<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * Perfils Controller
 *
 * @property \App\Model\Table\PerfilsTable $Perfils
 *
 * @method \App\Model\Entity\Perfil[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PerfilsController extends AppController
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
        $perfils = $this->paginate($this->Perfils->find()->where($this->generateConditionsFind(false)));

        $this->set(compact('perfils'));
    }

    /**
     * View method
     *
     * @param string|null $id Perfil id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $perfil = $this->Perfils->get($id, [
            'contain' => []
        ]);

        $this->set('perfil', $perfil);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $perfil = $this->Perfils->newEntity();
        if ($this->request->is('post')) {
            $perfil = $this->Perfils->patchEntity($perfil, $this->request->getData());
            if ($this->Perfils->save($perfil)) {
                $this->Flash->success(__('The perfil has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The perfil could not be saved. Please, try again.'));
        }
        $this->set(compact('perfil'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Perfil id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $perfil = $this->Perfils->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $perfil = $this->Perfils->patchEntity($perfil, $this->request->getData());
            if ($this->Perfils->save($perfil)) {
                $this->Flash->success(__('The perfil has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The perfil could not be saved. Please, try again.'));
        }
        $this->set(compact('perfil'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Perfil id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $perfil = $this->Perfils->get($id);
        if ($this->Perfils->delete($perfil)) {
            $this->Flash->success(__('The perfil has been deleted.'));
        } else {
            $this->Flash->error(__('The perfil could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
