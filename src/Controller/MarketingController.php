<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Controller;


use App\Model\Entity\User;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\Mailer\MailerAwareTrait;

class MarketingController extends AppController
{
    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->validateActions();
    }

    public function email($cliente = null){
        if($cliente){
            $cliente = $this->getTableLocator()->get('Users')->find()->where(['id' => $cliente])->first();
        }
        if($this->getRequest()->is('post')){
            $template = $this->getRequest()->getData('template');
            $titulo = $this->getRequest()->getData('titulo');
            $success = $this->sendEmailNotification($template, $titulo, $cliente);
            if ($success) {
                $this->Flash->success(__('Enviado(s) Com Sucesso.'));
            } else {
                $this->Flash->error(__('Erro ao enviar email(s), tente novamente.'));
            }
        }
        $this->set(compact('cliente'));
    }

    use MailerAwareTrait;
    private function sendEmailNotification($template, $titulo, User $cliente = null){
        try{
            //Se tem cliente especifico manda so pra ele
            if($cliente){
                $this->getMailer('Propaganda')->send('sendEmail', [$template, $titulo, $cliente->login]);
                //Se nao tem especifico manda pra todos.
            }else{
                /** @var $clientes User[]*/
                $clientes = $this->getTableLocator()->get('Users')->find()->where(['tipo' => User::TIPO_CLIENTE]);
                foreach ($clientes as $cliente){
                    $this->getMailer('Propaganda')->send('sendEmail', [$template, $titulo, $cliente->login]);
                }
            }
            return true;
        }catch (\Exception $exception){
            return false;
        }

    }

}