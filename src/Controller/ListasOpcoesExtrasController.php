<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\ExceptionSQLMessage;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * ListasOpcoesExtras Controller
 *
 * @property \App\Model\Table\ListasOpcoesExtrasTable $ListasOpcoesExtras
 *
 * @method \App\Model\Entity\ListasOpcoesExtra[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListasOpcoesExtrasController extends AppController
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
            'contain' => ['Listas', 'OpcoesExtras']
        ];
        $listasOpcoesExtras = $this->paginate($this->ListasOpcoesExtras->find()->where($this->generateConditionsFind()));

        $this->set(compact('listasOpcoesExtras'));
    }

    /**
     * View method
     *
     * @param string|null $id Listas Opcoes Extra id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listasOpcoesExtra = $this->ListasOpcoesExtras->get($id, [
            'contain' => ['Listas', 'OpcoesExtras']
        ]);

        $this->set('listasOpcoesExtra', $listasOpcoesExtra);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $listasOpcoesExtra = $this->ListasOpcoesExtras->newEntity();
        if ($this->request->is('post')) {
            try{
                $listasOpcoesExtra = $this->ListasOpcoesExtras->patchEntity($listasOpcoesExtra, $this->request->getData());
                if ($this->ListasOpcoesExtras->save($listasOpcoesExtra)) {
                    $this->Flash->success(__('Relacionamento entre Lista e Opção adicionado com sucesso.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possível adicionar o relacionamento entre Lista e Opção, tente novamente.'));
            }catch (\Exception $exception){
                $message = new ExceptionSQLMessage();
                $this->Flash->error(__($message->getMessage($exception)));
            }

        }
        $listas = $this->ListasOpcoesExtras->Listas->find('list');
        $opcoesExtras = $this->ListasOpcoesExtras->OpcoesExtras->find('list');
        $this->set(compact('listasOpcoesExtra', 'listas', 'opcoesExtras'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Listas Opcoes Extra id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $listasOpcoesExtra = $this->ListasOpcoesExtras->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            try{
                $listasOpcoesExtra = $this->ListasOpcoesExtras->patchEntity($listasOpcoesExtra, $this->request->getData());
                if ($this->ListasOpcoesExtras->save($listasOpcoesExtra)) {
                    $this->Flash->success(__('Relacionamento entre Lista e Opção salvo com sucesso.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possível editar o relacionamento entre Lista e Opção, tente novamente.'));
            }catch (\Exception $exception){
                $message = new ExceptionSQLMessage();
                $this->Flash->error(__($message->getMessage($exception)));
            }
        }
        $listas = $this->ListasOpcoesExtras->Listas->find('list');
        $opcoesExtras = $this->ListasOpcoesExtras->OpcoesExtras->find('list');
        $this->set(compact('listasOpcoesExtra', 'listas', 'opcoesExtras'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Listas Opcoes Extra id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $listasOpcoesExtra = $this->ListasOpcoesExtras->get($id);
        if ($this->ListasOpcoesExtras->delete($listasOpcoesExtra)) {
            $this->Flash->success(__('Relacionamento entre Lista e Opção excluido com sucesso'));
        } else {
            $this->Flash->error(__('Não foi possível excluir o relacionamento entre Lista e Opção, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
