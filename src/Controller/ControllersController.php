<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * Controllers Controller
 *
 * @property \App\Model\Table\ControllersTable $Controllers
 *
 * @method \App\Model\Entity\Controller[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ControllersController extends AppController
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
        $controllers = $this->paginate($this->Controllers->find()->where($this->generateConditionsFind(false)));

        $this->set(compact('controllers'));
    }

    /**
     * View method
     *
     * @param string|null $id Controller id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $controller = $this->Controllers->get($id, [
            'contain' => []
        ]);

        $this->set('controller', $controller);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $controller = $this->Controllers->newEntity();
        if ($this->request->is('post')) {
            $controller = $this->Controllers->patchEntity($controller, $this->request->getData());
            if ($this->Controllers->save($controller)) {
                $this->Flash->success(__('The controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The controller could not be saved. Please, try again.'));
        }
        $this->set(compact('controller'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Controller id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $controller = $this->Controllers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $controller = $this->Controllers->patchEntity($controller, $this->request->getData());
            if ($this->Controllers->save($controller)) {
                $this->Flash->success(__('The controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The controller could not be saved. Please, try again.'));
        }
        $this->set(compact('controller'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Controller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $controller = $this->Controllers->get($id);
        if ($this->Controllers->delete($controller)) {
            $this->Flash->success(__('The controller has been deleted.'));
        } else {
            $this->Flash->error(__('The controller could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
