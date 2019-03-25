<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * CupomSite Controller
 *
 * @property \App\Model\Table\CupomSiteTable $CupomSite
 *
 * @method \App\Model\Entity\CupomSite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CupomSiteController extends AppController
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
        $cupomSite = $this->paginate($this->CupomSite->find()->where($this->generateConditionsFind(false)));
        $this->set(compact('cupomSite'));
    }

    /**
     * View method
     *
     * @param string|null $id Cupom Site id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cupomSite = $this->CupomSite->get($id, [
            'contain' => []
        ]);

        $this->set('cupomSite', $cupomSite);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cupomSite = $this->CupomSite->newEntity();
        if ($this->request->is('post')) {
            $cupomSite = $this->CupomSite->patchEntity($cupomSite, $this->request->getData());
            if ($this->CupomSite->save($cupomSite)) {
                $this->Flash->success(__('The cupom site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cupom site could not be saved. Please, try again.'));
        }
        $this->set(compact('cupomSite'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cupom Site id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cupomSite = $this->CupomSite->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cupomSite = $this->CupomSite->patchEntity($cupomSite, $this->request->getData());
            if ($this->CupomSite->save($cupomSite)) {
                $this->Flash->success(__('The cupom site has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cupom site could not be saved. Please, try again.'));
        }
        $this->set(compact('cupomSite'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cupom Site id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cupomSite = $this->CupomSite->get($id);
        if ($this->CupomSite->delete($cupomSite)) {
            $this->Flash->success(__('The cupom site has been deleted.'));
        } else {
            $this->Flash->error(__('The cupom site could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
