<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AlteracaoSenha $alteracaoSenha
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Alteracao Senhas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="alteracaoSenhas form large-9 medium-8 columns content">
    <?= $this->Form->create($alteracaoSenha) ?>
    <fieldset>
        <legend><?= __('Add Alteracao Senha') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('token');
            echo $this->Form->control('validade');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
