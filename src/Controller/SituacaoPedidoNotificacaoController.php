<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\FormasPagamento;
use App\Model\Entity\Pedido;
use App\Model\Entity\SituacaoPedidoNotificacao;
use App\Model\Entity\User;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\Mailer\MailerAwareTrait;

/**
 * SituacaoPedidoNotificacao Controller
 *
 * @property \App\Model\Table\SituacaoPedidoNotificacaoTable $SituacaoPedidoNotificacao
 *
 * @method \App\Model\Entity\SituacaoPedidoNotificacao[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SituacaoPedidoNotificacaoController extends AppController
{

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, $eventManager = null, $components = null)
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
        $situacaoPedidoNotificacao = $this->paginate($this->SituacaoPedidoNotificacao->find()->where($this->generateConditionsFind()));

        $this->set(compact('situacaoPedidoNotificacao'));
    }

    /**
     * View method
     *
     * @param string|null $id Situacao Pedido Notificacao id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $situacaoPedidoNotificacao = $this->SituacaoPedidoNotificacao->get($id, [
            'contain' => []
        ]);

        $this->set('situacaoPedidoNotificacao', $situacaoPedidoNotificacao);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $situacaoPedidoNotificacao = $this->SituacaoPedidoNotificacao->newEntity();
        if ($this->request->is('post')) {
            $situacaoPedidoNotificacao = $this->SituacaoPedidoNotificacao->patchEntity($situacaoPedidoNotificacao, $this->request->getData());
            if ($this->SituacaoPedidoNotificacao->save($situacaoPedidoNotificacao)) {
                $this->Flash->success(__('Notificação Pedido adicionada com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $this->set(compact('situacaoPedidoNotificacao'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Situacao Pedido Notificacao id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $situacaoPedidoNotificacao = $this->SituacaoPedidoNotificacao->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $situacaoPedidoNotificacao = $this->SituacaoPedidoNotificacao->patchEntity($situacaoPedidoNotificacao, $this->request->getData());
            if ($this->SituacaoPedidoNotificacao->save($situacaoPedidoNotificacao)) {
                $this->Flash->success(__('Notificação Pedido alterada com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro, tente novamente.'));
        }
        $this->set(compact('situacaoPedidoNotificacao'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Situacao Pedido Notificacao id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $situacaoPedidoNotificacao = $this->SituacaoPedidoNotificacao->get($id);
        if ($this->SituacaoPedidoNotificacao->delete($situacaoPedidoNotificacao)) {
            $this->Flash->success(__('Notificação Pedido excluída com sucesso.'));
        } else {
            $this->Flash->error(__('Erro, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    use MailerAwareTrait;
    public function renderTemplate(Pedido $pedido, SituacaoPedidoNotificacao $notificacao){
        /** @var $user User*/
        $user = $this->getTableLocator()->get('Users')->find()->where(['id' => $pedido->user_id])->first();
        $titulo = $this->replaceString($pedido, $user ,$notificacao->template_titulo);
        $corpo = $this->replaceString($pedido, $user, $notificacao->template_mensagem);
        $to = $user->login;
        $this->getMailer('Notificacao')->send('sendEmail', [$titulo, $corpo, $to]);
    }

    private function replaceString(Pedido $pedido, User $user, $template){
        $statusList = Pedido::getDeliveryStatusList();
        $cliente = $user->nome_completo;
        $pedidoId = $pedido->id;
        $valorTotal = $pedido->getValorTotal();
        $valorDesconto = $pedido->valor_desconto;
        $valorAcrescimo = $pedido->valor_acrescimo;
        $valorProdutos = $pedido->valor_produtos;
        $rejeicao = $pedido->motivo_rejeicao;
        $tempoProducao = $pedido->tempo_producao_aproximado_minutos;
        /** @var $formaPagamento FormasPagamento*/
        $formaPagamento = $this->getTableLocator()->get('FormasPagamentos')->find()->where(['id' => $pedido->formas_pagamento_id])->first();
        $formaPagamento = $formaPagamento->nome;
        $situacao = $statusList[$pedido->status_pedido];
        $template = str_ireplace(SituacaoPedidoNotificacao::NOME_LOJA, EmpresaUtils::NOME_EMPRESA_LOJA, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::NOME_SITEMA, EmpresaUtils::NOME_SISTEMA, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::LINK_SITE, EmpresaUtils::LINK_SITE, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::USER_NAME, $cliente, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::PEDIDO_ID, $pedidoId, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::PEDIDO_VALOR, $valorTotal, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::PEDIDO_DESCONTO, $valorDesconto, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::PEDIDO_ACRESCIMO, $valorAcrescimo, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::PEDIDO_PRODUTOS, $valorProdutos, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::PEDIDO_REJEICAO, $rejeicao, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::TEMPO_PRODUCAO, $tempoProducao, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::FORMA_PAGAMENTO, $formaPagamento, $template);
        $template = str_ireplace(SituacaoPedidoNotificacao::PEDIDO_STATUS, $situacao, $template);
        return $template;
    }
}
