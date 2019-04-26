<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Controller;


use App\Model\Entity\User;
use Cake\Mailer\MailerAwareTrait;

class MarketingController extends AppController
{
    public function email(){
        if($this->getRequest()->is('post')){
            $template = $this->getRequest()->getData('template');
            $titulo = $this->getRequest()->getData('titulo');
            $this->sendEmailNotification($template, $titulo);
        }
    }

    use MailerAwareTrait;
    private function sendEmailNotification($template, $titulo){
        /** @var $clientes User[]*/
        $clientes = $this->getTableLocator()->get('Users')->find()->where(['tipo' => User::TIPO_CLIENTE]);
        foreach ($clientes as $cliente){
            $this->getMailer('Propaganda')->send('sendEmail', [$template, $titulo, $cliente->login]);
        }

    }

}