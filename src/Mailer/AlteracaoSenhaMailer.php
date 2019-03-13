<?php
namespace App\Mailer;

use App\Model\Entity\AlteracaoSenha;
use Cake\Mailer\Mailer;

/**
 * AlteracaoSenha mailer.
 */
class AlteracaoSenhaMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'AlteracaoSenha';

    public function sendEmail(AlteracaoSenha $alteracaoSenha){
        $this->to([$alteracaoSenha->user->login])
            ->setProfile(['gmail'])
            ->setEmailFormat('html')
            ->setTemplate('alteracao_senha')
            ->setViewVars(['token' => $alteracaoSenha->token])
            ->setSubject('Alteracao De Senha LaDelivery');
    }
}
