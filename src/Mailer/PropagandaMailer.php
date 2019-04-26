<?php
namespace App\Mailer;

use App\Model\Entity\AlteracaoSenha;
use Cake\Mailer\Mailer;

/**
 * PropagandaMailer mailer.
 */
class PropagandaMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'Propaganda';

    public function sendEmail($template, $titulo, $allEmails){
        $this->setTo([$allEmails])
            ->setProfile(['gmail'])
            ->setEmailFormat('html')
            ->setTemplate('propaganda')
            ->setViewVars(['template' => $template])
            ->setSubject($titulo);
    }
}
