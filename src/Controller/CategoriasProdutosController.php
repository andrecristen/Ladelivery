<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Midia;
use App\Model\ExceptionSQLMessage;
use App\Model\Utils\EmpresaUtils;
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
    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->empresaUtils = new EmpresaUtils();
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
            'contain' => ['Empresas']
        ];
        $categoriasProdutos = $this->paginate($this->CategoriasProdutos->find()->where($this->generateConditionsFind()));
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
            $categoriasProduto->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if($this->request->getData('uploadfile')){
                $midiaController = new MidiasController();
                $file = $_FILES['uploadfile'];
                if($file['name'] != ""){
                    $midia = $midiaController->newMidiaByUpload($file, Midia::TIPO_CATEGORIA);
                    if(!$midia){
                        $this->Flash->error(__('Erro ao gravar imagem.'));
                        return;
                    }
                    $categoriasProduto->midia_id = $midia->id;
                }
            }
            if ($this->CategoriasProdutos->save($categoriasProduto)) {
                $this->Flash->success(__('Categoria adicionada com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível adicionar a categoria, tente novamente.'));
        }
        $this->set(compact('categoriasProduto'));
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
            $categoriasProduto->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if($this->request->getData('uploadfile')){
                $midiaController = new MidiasController();
                $file = $_FILES['uploadfile'];
                if($file['name'] != ""){
                    $midia = $midiaController->newMidiaByUpload($file, Midia::TIPO_CATEGORIA);
                    if(!$midia){
                        $this->Flash->error(__('Erro ao gravar imagem.'));
                        return;
                    }
                    $categoriasProduto->midia_id = $midia->id;
                }
            }
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
