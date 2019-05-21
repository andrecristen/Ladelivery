<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
//$this->setLayout(null);
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Registrar-se') ?></legend>
        <?php
        echo $this->Form->control('nome_completo');
        echo $this->Form->control('apelido');
        ?>
    </fieldset>
    <fieldset>
        <legend>Dados login</legend>
        <?php
        echo $this->Form->control('login',['type'=>'email']);
        echo $this->Form->control('password', ['label'=>'Senha']);
        echo $this->Form->control('confirm_password', ['label'=>'Confirmar Senha', 'type'=>'password', 'required'=>'required']);
        ?>
    </fieldset>
    <fieldset>
        <legend>Nascimento</legend>
        <?php
        echo $this->Form->control('dia_nascimento', ['label'=>'Dia']);
        echo $this->Form->control('mes_nascimento', ['label'=>'Mês']);
        echo $this->Form->control('ano_nascimento', ['label'=>'Ano']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Registrar')) ?>
    <?= $this->Form->end() ?>
</div>
