<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TemposMedios Controller
 *
 * @property \App\Model\Table\TemposMediosTable $TemposMedios
 *
 * @method \App\Model\Entity\TemposMedio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TemposMediosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $temposMedios = $this->paginate($this->TemposMedios);

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
            if ($this->TemposMedios->save($temposMedio)) {
                $this->Flash->success(__('The tempos medio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tempos medio could not be saved. Please, try again.'));
        }
        $empresas = $this->TemposMedios->Empresas->find('list');
        $this->set(compact('temposMedio', 'empresas'));
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
            if ($this->TemposMedios->save($temposMedio)) {
                $this->Flash->success(__('The tempos medio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tempos medio could not be saved. Please, try again.'));
        }
        $empresas = $this->TemposMedios->Empresas->find('list');
        $this->set(compact('temposMedio', 'empresas'));
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
}
