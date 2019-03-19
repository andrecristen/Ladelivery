<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HorariosAtendimentos Controller
 *
 * @property \App\Model\Table\HorariosAtendimentosTable $HorariosAtendimentos
 *
 * @method \App\Model\Entity\HorariosAtendimento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HorariosAtendimentosController extends AppController
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
        $horariosAtendimentos = $this->paginate($this->HorariosAtendimentos);

        $this->set(compact('horariosAtendimentos'));
    }

    /**
     * View method
     *
     * @param string|null $id Horarios Atendimento id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horariosAtendimento = $this->HorariosAtendimentos->get($id, [
            'contain' => ['Empresas']
        ]);

        $this->set('horariosAtendimento', $horariosAtendimento);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $horariosAtendimento = $this->HorariosAtendimentos->newEntity();
        if ($this->request->is('post')) {
            $horariosAtendimento = $this->HorariosAtendimentos->patchEntity($horariosAtendimento, $this->request->getData());
            if ($this->HorariosAtendimentos->save($horariosAtendimento)) {
                $this->Flash->success(__('The horarios atendimento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horarios atendimento could not be saved. Please, try again.'));
        }
        $empresas = $this->HorariosAtendimentos->Empresas->find('list');
        $this->set(compact('horariosAtendimento', 'empresas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Horarios Atendimento id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horariosAtendimento = $this->HorariosAtendimentos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horariosAtendimento = $this->HorariosAtendimentos->patchEntity($horariosAtendimento, $this->request->getData());
            if ($this->HorariosAtendimentos->save($horariosAtendimento)) {
                $this->Flash->success(__('The horarios atendimento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horarios atendimento could not be saved. Please, try again.'));
        }
        $empresas = $this->HorariosAtendimentos->Empresas->find('list');
        $this->set(compact('horariosAtendimento', 'empresas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Horarios Atendimento id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horariosAtendimento = $this->HorariosAtendimentos->get($id);
        if ($this->HorariosAtendimentos->delete($horariosAtendimento)) {
            $this->Flash->success(__('The horarios atendimento has been deleted.'));
        } else {
            $this->Flash->error(__('The horarios atendimento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
