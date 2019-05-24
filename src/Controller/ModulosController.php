<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * Modulos Controller
 *
 * @property \App\Model\Table\ModulosTable $Modulos
 *
 * @method \App\Model\Entity\Modulo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModulosController extends AppController
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
        $modulos = $this->paginate($this->Modulos);

        $this->set(compact('modulos'));
    }

    /**
     * View method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $modulo = $this->Modulos->get($id, [
            'contain' => []
        ]);

        $this->set('modulo', $modulo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $modulo = $this->Modulos->newEntity();
        if ($this->request->is('post')) {
            $modulo = $this->Modulos->patchEntity($modulo, $this->request->getData());
            if ($this->Modulos->save($modulo)) {
                $this->Flash->success(__('The modulo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The modulo could not be saved. Please, try again.'));
        }
        $this->set(compact('modulo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $modulo = $this->Modulos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modulo = $this->Modulos->patchEntity($modulo, $this->request->getData());
            if ($this->Modulos->save($modulo)) {
                $this->Flash->success(__('The modulo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The modulo could not be saved. Please, try again.'));
        }
        $this->set(compact('modulo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $modulo = $this->Modulos->get($id);
        if ($this->Modulos->delete($modulo)) {
            $this->Flash->success(__('The modulo has been deleted.'));
        } else {
            $this->Flash->error(__('The modulo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
