<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * CategoriasProdutosImagens Controller
 *
 * @property \App\Model\Table\CategoriasProdutosImagensTable $CategoriasProdutosImagens
 *
 * @method \App\Model\Entity\CategoriasProdutosImagen[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriasProdutosImagensController extends AppController
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
            'contain' => ['CategoriasProdutos']
        ];
        $categoriasProdutosImagens = $this->paginate($this->CategoriasProdutosImagens->find()->where($this->generateConditionsFind()));

        $this->set(compact('categoriasProdutosImagens'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Categorias Produtos Imagen id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoriasProdutosImagen = $this->CategoriasProdutosImagens->get($id);
        if ($this->CategoriasProdutosImagens->delete($categoriasProdutosImagen)) {
            $this->Flash->success(__('The categorias produtos imagen has been deleted.'));
        } else {
            $this->Flash->error(__('The categorias produtos imagen could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
