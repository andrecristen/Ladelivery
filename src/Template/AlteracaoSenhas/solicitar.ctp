<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AlteracaoSenha $alteracaoSenha
 */
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <?= $this->Form->create($alteracaoSenha) ?>
    <fieldset>
        <legend><?= __('Solicitar alteração de senha') ?></legend>
        <?php
        echo $this->Form->control('email', ['type'=> 'email', 'required' => 'required']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Solicitar')) ?>
    <?= $this->Form->end() ?>
</div>