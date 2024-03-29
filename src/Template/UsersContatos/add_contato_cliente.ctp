<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/" class="pull-left btn btn-danger"><i class="fas fa-home"></i> Início</a>
        <a href="/users/profile/<?= $_SESSION['Auth']['User']['id'] ?>" class="pull-left btn btn-success"><i
                    class="fas fa-user-circle"></i> Minha Conta</a>
        <a href="/users-contatos/meus-contatos" class="btn btn-primary"><i class="fas fa-phone"></i> Contatos</a>
    </div>
    <br/>
    <br/>
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
