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
                $this->Flash->default(__('Foi enviado um link para redefinição de senha ao seu email.'));
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
        $token = md5($token);
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
}
