<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
?>
<div style="margin-top: 67px;" class="container bootstrap snippet">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend>Alterar Senha</legend>
        <?php
        echo $this->Form->control('password', ['label'=>'Senha']);
        echo $this->Form->control('confirm_password', ['label'=>'Confirmar Senha', 'type'=>'password', 'required'=>'required']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>

