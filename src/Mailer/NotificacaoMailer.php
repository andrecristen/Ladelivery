<?php


namespace App\Mailer;


use App\Model\Entity\AlteracaoSenha;
use App\Model\Utils\EmpresaUtils;
use Cake\Mailer\Mailer;

class NotificacaoMailer extends Mailer
{
    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'Notificacao';

    public function sendEmail($titulo, $corpo, $toEmail){
        $this->to([$toEmail])
            ->setProfile(['gmail'])
            ->setEmailFormat('html')
            ->setTemplate('notificacao')
            ->setViewVars(['template' => $corpo])
            ->setSubject($titulo);
    }
}