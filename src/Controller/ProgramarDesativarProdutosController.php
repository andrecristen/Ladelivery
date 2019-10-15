<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\ExceptionSQLMessage;

/**
 * ProgramarDesativarProdutos Controller
 *
 * @property \App\Model\Table\ProgramarDesativarProdutosTable $ProgramarDesativarProdutos
 *
 * @method \App\Model\Entity\ProgramarDesativarProduto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProgramarDesativarProdutosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Produtos']
        ];
        $programarDesativarProdutos = $this->paginate($this->ProgramarDesativarProdutos->find()->where($this->generateConditionsFind()));

        $this->set(compact('programarDesativarProdutos'));
    }

    /**
     * View method
     *
     * @param string|null $id Programar Desativar Produto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $programarDesativarProduto = $this->ProgramarDesativarProdutos->get($id, [
            'contain' => ['Produtos']
        ]);

        $this->set('programarDesativarProduto', $programarDesativarProduto);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $programarDesativarProduto = $this->ProgramarDesativarProdutos->newEntity();
        try{
            if ($this->request->is('post')) {
                $programarDesativarProduto = $this->ProgramarDesativarProdutos->patchEntity($programarDesativarProduto, $this->request->getData());
                if ($this->ProgramarDesativarProdutos->save($programarDesativarProduto)) {
                    $this->Flash->success(__('Desativamento automático de produto adicionado com sucesso.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Erro ao adicionar, tente novamente.'));
            }
        }catch (\Exception $exception){
            $message = new ExceptionSQLMessage();
            $this->Flash->error(__($message->getMessage($exception)));
        }
        $produtos = $this->ProgramarDesativarProdutos->Produtos->find('list');
        $this->set(compact('programarDesativarProduto', 'produtos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Programar Desativar Produto id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $programarDesativarProduto = $this->ProgramarDesativarProdutos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $programarDesativarProduto = $this->ProgramarDesativarProdutos->patchEntity($programarDesativarProduto, $this->request->getData());
            if ($this->ProgramarDesativarProdutos->save($programarDesativarProduto)) {
                $this->Flash->success(__('Desativamento automático de produto alterado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao alterar, tente novamente.'));
        }
        $produtos = $this->ProgramarDesativarProdutos->Produtos->find('list');
        $this->set(compact('programarDesativarProduto', 'produtos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Programar Desativar Produto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $programarDesativarProduto = $this->ProgramarDesativarProdutos->get($id);
        if ($this->ProgramarDesativarProdutos->delete($programarDesativarProduto)) {
            $this->Flash->success(__('Desativamento automático de produto excluído com sucesso.'));
        } else {
            $this->Flash->error(__('Erro ao excluir, tente novamente..'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
