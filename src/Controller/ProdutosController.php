<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Lista;
use App\Model\Entity\ListasProduto;
use App\Model\Entity\Midia;
use App\Model\Entity\ProdutosImagen;
use App\Model\Table\ProdutosImagensTable;
use App\Model\Utils\EmpresaUtils;
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
    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->empresaUtils = new EmpresaUtils();
        $this->setPublicAction('getProduto');
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
            'contain' => ['CategoriasProdutos', 'Empresas']
        ];
        $produtos = $this->paginate($this->Produtos->find()->where($this->generateConditionsFind()));

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
            $produto->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if($this->request->getData('uploadfile')){
                $midiaController = new MidiasController();
                $file = $_FILES['uploadfile'];
                if($file['name'] != ""){
                    $midia = $midiaController->newMidiaByUpload($file, Midia::TIPO_PRODUTO);
                    if(!$midia){
                        $this->Flash->error(__('Erro ao gravar imagem.'));
                        return;
                    }
                    $produto->midia_id = $midia->id;
                }
            }
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('Produto adicionado com sucesso.'));
                foreach ($this->request->getData('listas') as $lista){
                    $controller = new ListasProdutosController();
                    $controller->newListaProduto($produto->id, intval(str_replace('number:','',$lista)));
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível adicionar o produto, tente novamente.'));
        }
        $categoriasProdutos = $this->Produtos->CategoriasProdutos->find('list');
        $listasModels = $this->getTableLocator()->get('Listas')->find()->where(['empresa_id' => $this->empresaUtils->getUserEmpresaId()]);
        foreach ($listasModels as $listasModel){
            $listas[$listasModel->id] = $listasModel->nome_lista;
        }
        $this->set(compact('produto', 'categoriasProdutos', 'listas'));
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
            $produto->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if($this->request->getData('uploadfile')){
                $midiaController = new MidiasController();
                $file = $_FILES['uploadfile'];
                if($file['name'] != ""){
                    $midia = $midiaController->newMidiaByUpload($file, Midia::TIPO_PRODUTO);
                    if(!$midia){
                        $this->Flash->error(__('Erro ao gravar imagem.'));
                        return;
                    }
                    $produto->midia_id = $midia->id;
                }
            }
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('Produto salvo com sucesso.'));
                $controller = new ListasProdutosController();
                $controller->deleteAllListasProduto($produto->id);
                foreach ($this->request->getData('listas') as $lista){
                    $controller->newListaProduto($produto->id, intval(str_replace('number:','',$lista)));
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível editar o produto, tente novamente.'));
        }
        $categoriasProdutos = $this->Produtos->CategoriasProdutos->find('list');
        /** @var $listasModels Lista[]*/
        $listasModels = $this->getTableLocator()->get('Listas')->find()->where(['empresa_id' => $this->empresaUtils->getUserEmpresaId()]);
        foreach ($listasModels as $listasModel){
            $listas[$listasModel->id] = $listasModel->nome_lista;
        }
        /** @var $listasProduto ListasProduto[]*/
        $listasProduto = $this->getTableLocator()->get('ListasProdutos')->find()->where(['produto_id' => $produto->id]);
        $listasProdutoArray = [];
        foreach ($listasProduto as $listaProduto){
            $listasProdutoArray[]['lista'] = $listaProduto->lista_id;
        }
        $produto->listas = $listasProdutoArray;
        $this->set(compact('produto', 'categoriasProdutos', 'listas'));
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
