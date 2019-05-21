<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <?= $this->Form->create($usersContato) ?>
    <fieldset>
        <legend><?= __('Adicionar Contato') ?></legend>
        <?php
        echo $this->Form->control('tipo',  ['options' => \App\Model\Entity\UsersContato::getTipoList()]);
        echo $this->Form->control('contato');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
