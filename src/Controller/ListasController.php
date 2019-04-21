<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\ListasOpcoesExtra;
use App\Model\Entity\OpcoesExtra;
use App\Model\ExceptionSQLMessage;
use App\Model\Table\ListasOpcoesExtrasTable;
use App\Model\Utils\EmpresaUtils;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\TableRegistry;

/**
 * Listas Controller
 *
 * @property \App\Model\Table\ListasTable $Listas
 *
 * @method \App\Model\Entity\Lista[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListasController extends AppController
{
    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->empresaUtils = new EmpresaUtils();
        $this->setPublicAction('getListas');
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
        $listas = $this->paginate($this->Listas->find()->where($this->generateConditionsFind()));

        $this->set(compact('listas'));
    }

    /**
     * View method
     *
     * @param string|null $id Lista id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lista = $this->Listas->get($id, [
            'contain' => ['OpcoesExtras']
        ]);

        $this->set('lista', $lista);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lista = $this->Listas->newEntity();
        if ($this->request->is('post')) {
            $lista = $this->Listas->patchEntity($lista, $this->request->getData());
            $lista->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->Listas->save($lista)) {
                $this->Flash->success(__('Lista adicionada com sucesso.'));
                $controller = new ListasOpcoesExtrasController();
                foreach ($this->request->getData('adicionais') as $opcao){
                    $ativo = false;
                    if(isset($opcao['ativo']) && $opcao['ativo'] != '0' ){
                        $ativo = true;
                    }
                    $controller->newListaOpcaoExtra($lista->id, intval(str_replace('number:','',$opcao['adicional'])), $ativo);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível adicionar a lista, tente novamente.'));
        }
        /** @var $opcoesExtrasModel OpcoesExtra[]*/
        $opcoesExtras =[];
        $opcoesExtrasModel = $this->Listas->OpcoesExtras->find()->where(['empresa_id' => $this->empresaUtils->getUserEmpresaId()]);
        foreach ($opcoesExtrasModel as $opcaoExtra){
            $opcoesExtras[$opcaoExtra->id] = $opcaoExtra->nome_adicional;
        }
        $this->set(compact('lista', 'opcoesExtras'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lista id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lista = $this->Listas->get($id, [
            'contain' => ['OpcoesExtras']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lista = $this->Listas->patchEntity($lista, $this->request->getData());
            $lista->empresa_id = $this->empresaUtils->getUserEmpresaId();
            if ($this->Listas->save($lista)) {
                $this->Flash->success(__('Lista salva com sucesso.'));
                $controller = new ListasOpcoesExtrasController();
                $controller->deleteAllListasAdicionais($lista->id);
                foreach ($this->request->getData('adicionais') as $opcao){
                    $ativo = false;
                    if(isset($opcao['ativo']) && $opcao['ativo'] != '0' ){
                        $ativo = true;
                    }
                    $controller->newListaOpcaoExtra($lista->id, intval(str_replace('number:','',$opcao['adicional'])), $ativo);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível editar a lista, tente novamente.'));
        }
        /** @var $opcoesExtrasModel OpcoesExtra[]*/
        $opcoesExtras =[];
        $opcoesExtrasModel = $this->Listas->OpcoesExtras->find()->where(['empresa_id' => $this->empresaUtils->getUserEmpresaId()]);
        foreach ($opcoesExtrasModel as $opcaoExtra){
            $opcoesExtras[$opcaoExtra->id] = $opcaoExtra->nome_adicional;
        }
        /** @var $listasAdicionais ListasOpcoesExtra[]*/
        $listasAdicionais = $this->getTableLocator()->get('ListasOpcoesExtras')->find()->where(['lista_id' => $lista->id]);
        $listasAdicionaisArray = [];
        foreach ($listasAdicionais as $listaAdicional){
            $listasAdicionaisArray[] = ['adicional' =>  $listaAdicional->opcoes_extra_id, 'ativo' => $listaAdicional->ativa] ;
        }
        $lista->adicionais = $listasAdicionaisArray;
        $this->set(compact('lista', 'opcoesExtras'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lista id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $lista = $this->Listas->get($id);
            if ($this->Listas->delete($lista)) {
                $this->Flash->success(__('Lista excluida com sucesso.'));
            } else {
                $this->Flash->error(__('Não foi possível excluir a lista, tente novamente'));
            }
            return $this->redirect(['action' => 'index']);
        } catch (\Exception $e) {
            $exMessage = new ExceptionSQLMessage();
            $this->Flash->error(__($exMessage->getMessage($e)));
            return $this->redirect(['action' => 'index']);
        }

    }

    public function getListas($produto = null)
    {
        $this->render(false);
        $tableLocator = new TableLocator();
        $listas = [];
        $options = [];
        $listasProdutosTable = $tableLocator->get('ListasProdutos');
        $listasProdutos = $listasProdutosTable->query();
        $listasProdutos->where(['produto_id' => $produto]);
        foreach ($listasProdutos as $listaProduto) {
            $this->render(false);
            $listas[] = $this->Listas->query()->where(['id' => $listaProduto->lista_id])->first();
            $listasOpcoesTable = $tableLocator->get('ListasOpcoesExtras');
            $listasOpcoes = $listasOpcoesTable->find()->where(['lista_id' => $listaProduto->lista_id, 'ativa' => true]);
            foreach ($listasOpcoes as $opcaoLista) {
                $opcoesTable = $tableLocator->get('OpcoesExtras');
                $opcao = $opcoesTable->query()->where(['id' => $opcaoLista->opcoes_extra_id]);
                $options[$listaProduto->lista_id][] = $opcao;
            }
        }
        echo json_encode(['listas' => $listas, 'options' => $options]);
    }
}
