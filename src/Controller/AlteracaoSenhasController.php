<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\AlteracaoSenha;
use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Cake\ORM\Locator\TableLocator;

use Cake\Mailer\MailerAwareTrait;

/**
 * AlteracaoSenhas Controller
 *
 * @property \App\Model\Table\AlteracaoSenhasTable $AlteracaoSenhas
 *
 * @method \App\Model\Entity\AlteracaoSenha[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AlteracaoSenhasController extends AppController
{

    public function solicitar(){
        $alteracaoSenha = $this->AlteracaoSenhas->newEntity();
        if($this->getRequest()->is('post')){
            $tableLocator = new TableLocator();
            $email = $this->request->getData('email');
            $user =  $tableLocator->get('Users')->find()->where(['login' => $email])->first();
            if(!$user){
                $this->Flash->error(__('Nenhum usuario localizado para o email informado.'));
                return;
            }
            $alteracaoSenha->user_id = $user->id;
            $alteracaoSenha->token = $this->generateTokenSenha();
            $date = new \DateTime();
            $date->modify('+3 day');
            $alteracaoSenha->validade =  $date;;
            if($this->AlteracaoSenhas->save($alteracaoSenha)){
                $this->sendEmailNotification($alteracaoSenha);
                $this->Flash->default(__('Foi enviado um link para redefinição de senha ao seu email, por favor verifique. Este link é válido por 3 dias.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }else{
                $this->Flash->error(__('Ocorreu um erro ao processar a operação, tente novamente!.'));
            }

        }
        $this->set(compact('alteracaoSenha'));
    }

    use MailerAwareTrait;
    private function sendEmailNotification(AlteracaoSenha $alteracaoSenha){
        $tableLocator = new TableLocator();
        $alteracaoSenha->user = $tableLocator->get('Users')->find()->where(['id' => $alteracaoSenha->user_id])->first();
        $this->getMailer('AlteracaoSenha')->send('sendEmail', [$alteracaoSenha]);
    }

    private function generateTokenSenha(){
        $date = new \DateTime();
        $token = 'LA'.$date->format('Ymdhis').microtime().'DEV'.rand(11111111,99999999);
        $token = str_replace(' ', '', $token);
        $token = str_replace('.', '', $token);
        return $token;
    }


    public function novaSenha($token = false){
        if(!$token){
            $this->Flash->error(__('Não localizado token na sua requisição!'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        if($this->getRequest()->is('post')){
            $senha = $this->request->getData('senha');
            $confirmar = $this->request->getData('confirmar');
            if($senha == $confirmar){
                /** @var $solicitacao AlteracaoSenha*/
               $solicitacao = $this->AlteracaoSenhas->find()->where(['token' => $token])->first();
               if($solicitacao->usado){
                   $this->Flash->error(__('Esse link de alteração de senha já foi usado'));
                   return;
               }
               $dataAtual = new \Cake\I18n\FrozenTime();
               $um = strtotime($solicitacao->validade);
               $dois = strtotime($dataAtual);
               if( $um < $dois){
                   $this->Flash->error(__('A validade desse link de alteração de senha expirou'));
                   return;
               }
               $tableLocator = new TableLocator();
               /** @var $userTable UsersTable*/
               $userTable = $tableLocator->get('Users');
               /** @var $user User*/
               $user = $userTable->find()->where(['id' => $solicitacao->user_id])->first();
               $user->password = $senha;
               if($userTable->save($user)){
                   $solicitacao->usado = true;
                   $this->Flash->default(__('Senha alterada!'));
                   $this->AlteracaoSenhas->save($solicitacao);
                   return $this->redirect(['controller' => 'Users', 'action' => 'login']);
               }else{
                   $this->Flash->error(__('Não foi possível alterar a senha!'));
               }
            }else{
                $this->Flash->error(__('Senhas não concidem, informe senhas iguais!'));
            }
        }
        $this->set(compact('token'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $alteracaoSenhas = $this->paginate($this->AlteracaoSenhas);

        $this->set(compact('alteracaoSenhas'));
    }

    /**
     * View method
     *
     * @param string|null $id Alteracao Senha id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $alteracaoSenha = $this->AlteracaoSenhas->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('alteracaoSenha', $alteracaoSenha);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $alteracaoSenha = $this->AlteracaoSenhas->newEntity();
        if ($this->request->is('post')) {
            $alteracaoSenha = $this->AlteracaoSenhas->patchEntity($alteracaoSenha, $this->request->getData());
            if ($this->AlteracaoSenhas->save($alteracaoSenha)) {
                $this->Flash->success(__('The alteracao senha has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The alteracao senha could not be saved. Please, try again.'));
        }
        $users = $this->AlteracaoSenhas->Users->find('list', ['limit' => 200]);
        $this->set(compact('alteracaoSenha', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Alteracao Senha id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $alteracaoSenha = $this->AlteracaoSenhas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $alteracaoSenha = $this->AlteracaoSenhas->patchEntity($alteracaoSenha, $this->request->getData());
            if ($this->AlteracaoSenhas->save($alteracaoSenha)) {
                $this->Flash->success(__('The alteracao senha has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The alteracao senha could not be saved. Please, try again.'));
        }
        $users = $this->AlteracaoSenhas->Users->find('list', ['limit' => 200]);
        $this->set(compact('alteracaoSenha', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Alteracao Senha id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $alteracaoSenha = $this->AlteracaoSenhas->get($id);
        if ($this->AlteracaoSenhas->delete($alteracaoSenha)) {
            $this->Flash->success(__('The alteracao senha has been deleted.'));
        } else {
            $this->Flash->error(__('The alteracao senha could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
