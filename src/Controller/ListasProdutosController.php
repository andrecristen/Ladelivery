<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\ExceptionSQLMessage;
use Cake\Datasource\ConnectionManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * ListasProdutos Controller
 *
 * @property \App\Model\Table\ListasProdutosTable $ListasProdutos
 *
 * @method \App\Model\Entity\ListasProduto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListasProdutosController extends AppController
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
            'contain' => ['Produtos', 'Listas']
        ];
        $listasProdutos = $this->paginate($this->ListasProdutos->find()->where($this->generateConditionsFind()));

        $this->set(compact('listasProdutos'));
    }

    /**
     * View method
     *
     * @param string|null $id Listas Produto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listasProduto = $this->ListasProdutos->get($id, [
            'contain' => ['Produtos', 'Listas']
        ]);

        $this->set('listasProduto', $listasProduto);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $listasProduto = $this->ListasProdutos->newEntity();
        if ($this->request->is('post')) {
            try {
                $listasProduto = $this->ListasProdutos->patchEntity($listasProduto, $this->request->getData());
                if ($this->ListasProdutos->save($listasProduto)) {
                    $this->Flash->success(__('Relacionamento entre Lista e Produto adicionado com sucesso'));
                    return $this->redirect(['action' => 'index']);
                }
            } catch (\Exception $exception) {
                $message = new ExceptionSQLMessage();
                $this->Flash->error(__($message->getMessage($exception)));
            }
        }
        $produtos = $this->ListasProdutos->Produtos->find('list');
        $listas = $this->ListasProdutos->Listas->find('list');
        $this->set(compact('listasProduto', 'produtos', 'listas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Listas Produto id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $listasProduto = $this->ListasProdutos->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                $listasProduto = $this->ListasProdutos->patchEntity($listasProduto, $this->request->getData());
                if ($this->ListasProdutos->save($listasProduto)) {
                    $this->Flash->success(__('Relacionamento entre Lista e Produto salvo com sucesso'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possível editar o relacionamento entre Lista e Produto, tente novamente.'));
            } catch (\Exception $exception) {
                $message = new ExceptionSQLMessage();
                $this->Flash->error(__($message->getMessage($exception)));
            }
        }
        $produtos = $this->ListasProdutos->Produtos->find('list');
        $listas = $this->ListasProdutos->Listas->find('list');
        $this->set(compact('listasProduto', 'produtos', 'listas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Listas Produto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $listasProduto = $this->ListasProdutos->get($id);
        if ($this->ListasProdutos->delete($listasProduto)) {
            $this->Flash->success(__('Relacionamento entre Lista e Produto excluido com sucesso'));
        } else {
            $this->Flash->error(__('Não foi possível excluir o relacionamento entre Lista e Produto, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function newListaProduto($produtoId, $listaId){
        $listaProduto = $this->ListasProdutos->newEntity();
        $listaProduto->produto_id = $produtoId;
        $listaProduto->lista_id = $listaId;
        if($this->ListasProdutos->save($listaProduto)){
            return true;
        }
        return false;
    }
    public function deleteAllListasProduto($produtoId){
        $connection = ConnectionManager::get('default');
        $result = $connection->execute('DELETE FROM listas_produtos WHERE produto_id = '.$produtoId);
        return $result;
    }
}
