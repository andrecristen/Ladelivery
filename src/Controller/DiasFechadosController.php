<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DiasFechados Controller
 *
 * @property \App\Model\Table\DiasFechadosTable $DiasFechados
 *
 * @method \App\Model\Entity\DiasFechado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DiasFechadosController extends AppController
{

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
        $diasFechados = $this->paginate($this->DiasFechados);
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
            if ($this->DiasFechados->save($diasFechado)) {
                $this->Flash->success(__('The dias fechado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dias fechado could not be saved. Please, try again.'));
        }
        $empresas = $this->DiasFechados->Empresas->find('list');
        $this->set(compact('diasFechado','empresas'));
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
            if ($this->DiasFechados->save($diasFechado)) {
                $this->Flash->success(__('The dias fechado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dias fechado could not be saved. Please, try again.'));
        }
        $empresas = $this->DiasFechados->Empresas->find('list');
        $this->set(compact('diasFechado', 'empresas'));
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
            $this->Flash->success(__('The dias fechado has been deleted.'));
        } else {
            $this->Flash->error(__('The dias fechado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
