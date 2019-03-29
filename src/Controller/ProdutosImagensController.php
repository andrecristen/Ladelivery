<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

/**
 * ProdutosImagens Controller
 *
 * @property \App\Model\Table\ProdutosImagensTable $ProdutosImagens
 *
 * @method \App\Model\Entity\ProdutosImagen[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProdutosImagensController extends AppController
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
            'contain' => ['Produtos']
        ];
        $produtosImagens = $this->paginate($this->ProdutosImagens->find()->where($this->generateConditionsFind()));

        $this->set(compact('produtosImagens'));
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produtosImagen = $this->ProdutosImagens->get($id);
        if ($this->ProdutosImagens->delete($produtosImagen)) {
            $this->Flash->success(__('The produtos imagen has been deleted.'));
        } else {
            $this->Flash->error(__('The produtos imagen could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
