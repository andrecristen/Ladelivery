<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\ProdutosImagen;
use App\Model\Table\ProdutosImagensTable;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\TableRegistry;

/**
 * Produtos Controller
 *
 * @property \App\Model\Table\ProdutosTable $Produtos
 *
 * @method \App\Model\Entity\Produto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProdutosController extends AppController
{
    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->pertmiteAction('getProduto');
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
            'contain' => ['CategoriasProdutos']
        ];
        $produtos = $this->paginate($this->Produtos);

        $this->set(compact('produtos'));
    }

    /**
     * View method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $produto = $this->Produtos->get($id, [
            'contain' => ['CategoriasProdutos']
        ]);

        $this->set('produto', $produto);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $produto = $this->Produtos->newEntity();
        if ($this->request->is('post')) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('Produto adicionado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível adicionar o produto, tente novamente.'));
        }
        $categoriasProdutos = $this->Produtos->CategoriasProdutos->find('list');
        $this->set(compact('produto', 'categoriasProdutos'));
    }

    /**
     * AddImage method
     *
     * @return \Cake\Http\Response|null Redirects on successful addImage, renders view otherwise.
     */
    public function addImage()
    {
        if (!$this->getRequest()->is('post')) {
            $produto = $this->Produtos->newEntity();
            $produtos = $this->Produtos->find('list');
            $this->set(compact('produto', 'produtos'));
        } else {
            try {
                $tableLocator = new TableLocator();
                $prodId = $this->getRequest()->getData('produto_id');
                $produtosImagensTable = $tableLocator->get('ProdutosImagens');
                $existImage = $produtosImagensTable->query();
                $existImage->where(['produto_id' => $prodId]);
                $existImage = $existImage->first();
                if ($existImage !== null) {
                    unlink(WWW_ROOT . 'img' . DS . 'produtos' . DS . $existImage->nome_imagem);
                }
                $file = $_FILES;
                $file = $file['uploadfile'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img' . DS . 'produtos' . DS . $prodId . '_' . $file['name']);
                $produtoImagem = $produtosImagensTable->newEntity();
                $produtoImagem->nome_imagem = $prodId . '_' . $file['name'];
                $produtoImagem->produto_id = $prodId;
                if ($produtosImagensTable->save($produtoImagem)) {
                    $this->Flash->success(__('Imagem vinculada ao produto com sucesso.'));
                } else {
                    throw new \Exception('Não foi possível vincular imagem ao produto');
                }

                return $this->redirect(['controller' => 'ProdutosImagens', 'action' => 'index']);
            } catch (\Exception $e) {
                $this->Flash->error(__('Não foi possível adicionar imagem ao produto erro recebido: ' . $e->getMessage()));
            }

        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $produto = $this->Produtos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('Produto salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível editar o produto, tente novamente.'));
        }
        $categoriasProdutos = $this->Produtos->CategoriasProdutos->find('list');
        $this->set(compact('produto', 'categoriasProdutos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produto = $this->Produtos->get($id);
        if ($this->Produtos->delete($produto)) {
            $this->Flash->success(__('Produto excluído com sucesso.'));
        } else {
            $this->Flash->error(__('Não foi possível excluir o produto, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function getproduto($id = null)
    {
        $this->render(false);
        $produto = $this->Produtos->get($id, [
            'contain' => []
        ]);
        echo json_encode($produto);
    }
}
