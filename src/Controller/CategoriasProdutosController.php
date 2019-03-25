<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\ExceptionSQLMessage;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\TableRegistry;

/**
 * CategoriasProdutos Controller
 *
 * @property \App\Model\Table\CategoriasProdutosTable $CategoriasProdutos
 *
 * @method \App\Model\Entity\CategoriasProduto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriasProdutosController extends AppController
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
        $categoriasProdutos = $this->paginate($this->CategoriasProdutos->find()->where($this->generateConditionsFind(false)));
        $this->set(compact('categoriasProdutos'));
    }

    /**
     * View method
     *
     * @param string|null $id Categorias Produto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoriasProduto = $this->CategoriasProdutos->get($id, [
            'contain' => ['Produtos']
        ]);

        $this->set('categoriasProduto', $categoriasProduto);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoriasProduto = $this->CategoriasProdutos->newEntity();
        if ($this->request->is('post')) {
            $categoriasProduto = $this->CategoriasProdutos->patchEntity($categoriasProduto, $this->request->getData());
            if ($this->CategoriasProdutos->save($categoriasProduto)) {
                $this->Flash->success(__('Categoria adicionada com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível adicionar a categoria, tente novamente.'));
        }
        $this->set(compact('categoriasProduto'));
    }

    /**
     * AddImage method
     *
     * @return \Cake\Http\Response|null Redirects on successful addImage, renders view otherwise.
     */
    public function addImage(){
        if(!$this->getRequest()->is('post')){
            $categoria = $this->CategoriasProdutos->newEntity();
            $categorias = $this->CategoriasProdutos->find('list');
            $this->set(compact('categoria', 'categorias'));
        }else{
            try{
                $tableLocator = new TableLocator();
                $catId = $this->getRequest()->getData('categorias_produto_id');
                $categoriasImagensTable = $tableLocator->get('CategoriasProdutosImagens');
                $existImage = $categoriasImagensTable->query();
                $existImage->where(['categorias_produto_id'=>$catId]);
                $existImage = $existImage->first();
                if($existImage !== null){
                    unlink(WWW_ROOT . 'img' .DS. 'categorias' .DS.$existImage->nome_imagem);
                }
                $file =  $_FILES;
                $file =  $file['uploadfile'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img' .DS. 'categorias' .DS. $catId.'_'.$file['name']);
                $produtoImagem = $categoriasImagensTable->newEntity();
                $produtoImagem->nome_imagem = $catId.'_'.$file['name'];
                $produtoImagem->categorias_produto_id = $catId;
                if ($categoriasImagensTable->save($produtoImagem)) {
                    $this->Flash->success(__('Imagem vinculada a categoria com sucesso.'));
                }else{
                    throw new \Exception('Não foi possível vincular imagem a categoria');
                }

                return $this->redirect(['controller' => 'CategoriasProdutosImagens', 'action' => 'index']);
            }catch (\Exception $e){
                $this->Flash->error(__('Não foi possível adicionar imagem a categoria erro recebido: '.$e->getMessage()));
            }

        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Categorias Produto id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categoriasProduto = $this->CategoriasProdutos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoriasProduto = $this->CategoriasProdutos->patchEntity($categoriasProduto, $this->request->getData());
            if ($this->CategoriasProdutos->save($categoriasProduto)) {
                $this->Flash->success(__('Categoria salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível editar a categoria, tente novamente.'));
        }
        $this->set(compact('categoriasProduto'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Categorias Produto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try{
            $this->request->allowMethod(['post', 'delete']);
            $categoriasProduto = $this->CategoriasProdutos->get($id);
            if ($this->CategoriasProdutos->delete($categoriasProduto)) {
                $this->Flash->success(__('Categoria excluida com sucesso.'));
            } else {
                $this->Flash->error(__('Naõ foi possível excluir a categoria, tente novamente.'));
            }
            return $this->redirect(['action' => 'index']);
        }catch (\Exception $e){
            $exMessage =  new ExceptionSQLMessage();
            $this->Flash->error(__($exMessage->getMessage($e)));
            return $this->redirect(['action' => 'index']);
        }
    }
}
