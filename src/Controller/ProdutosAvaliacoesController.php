<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * ProdutosAvaliacoes Controller
 *
 * @property \App\Model\Table\ProdutosAvaliacoesTable $ProdutosAvaliacoes
 *
 * @method \App\Model\Entity\ProdutosAvaliaco[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProdutosAvaliacoesController extends AppController
{

    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->empresaUtils = new EmpresaUtils();
        $this->setPublicAction('listAvaliacoes');
        $this->setPublicAction('addAvaliacao');
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
            'contain' => ['Produtos', 'Users']
        ];
        $produtosAvaliacoes = $this->paginate($this->ProdutosAvaliacoes);

        $this->set(compact('produtosAvaliacoes'));
    }

    public function addAvaliacao($produtoId){
        $this->render(false);
        $produtoAvaliacao = $this->ProdutosAvaliacoes->newEntity();
        if ($this->request->is('post')) {
            $produtoAvaliacao = $this->ProdutosAvaliacoes->patchEntity($produtoAvaliacao, $this->request->getData());
            $produtoAvaliacao->produto_id = $produtoId;
            $produtoAvaliacao->user_id = $this->empresaUtils->getUserId();
            if ($this->ProdutosAvaliacoes->save($produtoAvaliacao)) {
                $this->Flash->success(__('Avaliação salva com sucesso, agradecemos pelo feedback.'));

                return $this->redirect(['action' => 'listAvaliacoes', $produtoAvaliacao->produto_id]);
            }
            $this->Flash->error(__('Algo de errado aconteceu'));
        }
        return $this->redirect(['action' => 'listAvaliacoes', $produtoAvaliacao->produto_id]);
    }

    public function listAvaliacoes($produtoId = null){
        $this->paginate = [
            'contain' => ['Produtos', 'Users']
        ];
        $produtoAvaliacao = $this->ProdutosAvaliacoes->newEntity();
        $produtoAvaliacao->produto_id = $produtoId;
        $produtosAvaliacoes = $this->paginate($this->ProdutosAvaliacoes->find()->where(['produto_id' => $produtoId]));
        $showForm = false;
        if($this->empresaUtils->getUserId()){
            $showForm = true;
        }
        $produto = $this->getTableLocator()->get('Produtos')->find()->where(['id' => $produtoId])->first();
        $this->set(compact('produtosAvaliacoes', 'produtoId', 'produtoAvaliacao', 'showForm', 'produto'));
    }
}
