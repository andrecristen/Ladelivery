<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersContato $usersContato
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Contato'), ['action' => 'edit', $usersContato->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Contato'), ['action' => 'delete', $usersContato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersContato->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Contatos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Contato'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersContatos view large-9 medium-8 columns content">
    <h3><?= h($usersContato->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersContato->has('user') ? $this->Html->link($usersContato->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $usersContato->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contato') ?></th>
            <td><?= h($usersContato->contato) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersContato->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= $this->Number->format($usersContato->tipo) ?></td>
        </tr>
    </table>
</div>
