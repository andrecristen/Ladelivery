<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * OpcoesExtras Controller
 *
 * @property \App\Model\Table\OpcoesExtrasTable $OpcoesExtras
 *
 * @method \App\Model\Entity\OpcoesExtra[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OpcoesExtrasController extends AppController
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
        $opcoesExtras = $this->paginate($this->OpcoesExtras);

        $this->set(compact('opcoesExtras'));
    }

    /**
     * View method
     *
     * @param string|null $id Opcoes Extra id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $opcoesExtra = $this->OpcoesExtras->get($id, [
            'contain' => ['Listas']
        ]);

        $this->set('opcoesExtra', $opcoesExtra);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $opcoesExtra = $this->OpcoesExtras->newEntity();
        if ($this->request->is('post')) {
            $opcoesExtra = $this->OpcoesExtras->patchEntity($opcoesExtra, $this->request->getData());
            if ($this->OpcoesExtras->save($opcoesExtra)) {
                $this->Flash->success(__('Adicional adicionado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível adicionar o adicional, tente novamente.'));
        }
        $listas = $this->OpcoesExtras->Listas->find('list');
        $this->set(compact('opcoesExtra', 'listas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Opcoes Extra id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $opcoesExtra = $this->OpcoesExtras->get($id, [
            'contain' => ['Listas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $opcoesExtra = $this->OpcoesExtras->patchEntity($opcoesExtra, $this->request->getData());
            if ($this->OpcoesExtras->save($opcoesExtra)) {
                $this->Flash->success(__('Adicional salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível editar o adicional, tente novamente.'));
        }
        $listas = $this->OpcoesExtras->Listas->find('list');
        $this->set(compact('opcoesExtra', 'listas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Opcoes Extra id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $opcoesExtra = $this->OpcoesExtras->get($id);
        if ($this->OpcoesExtras->delete($opcoesExtra)) {
            $this->Flash->success(__('Adicional excluido com sucesso.'));
        } else {
            $this->Flash->error(__('Não foi possível excluir o adicional, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
