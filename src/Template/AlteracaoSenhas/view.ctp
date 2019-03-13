<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AlteracaoSenha $alteracaoSenha
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Alteracao Senha'), ['action' => 'edit', $alteracaoSenha->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Alteracao Senha'), ['action' => 'delete', $alteracaoSenha->id], ['confirm' => __('Are you sure you want to delete # {0}?', $alteracaoSenha->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Alteracao Senhas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Alteracao Senha'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="alteracaoSenhas view large-9 medium-8 columns content">
    <h3><?= h($alteracaoSenha->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $alteracaoSenha->has('user') ? $this->Html->link($alteracaoSenha->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $alteracaoSenha->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Token') ?></th>
            <td><?= h($alteracaoSenha->token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($alteracaoSenha->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Validade') ?></th>
            <td><?= h($alteracaoSenha->validade) ?></td>
        </tr>
    </table>
</div>
