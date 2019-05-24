<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Modulos'), ['controller' => 'Modulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Modulo'), ['controller' => 'Modulos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= h($menu->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Modulo') ?></th>
            <td><?= $menu->has('modulo') ? $this->Html->link($menu->modulo->id, ['controller' => 'Modulos', 'action' => 'view', $menu->modulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $menu->has('action') ? $this->Html->link($menu->action->descricao_action, ['controller' => 'Actions', 'action' => 'view', $menu->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Menu') ?></th>
            <td><?= h($menu->nome_menu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Icon Menu') ?></th>
            <td><?= h($menu->icon_menu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordem Menu') ?></th>
            <td><?= $this->Number->format($menu->ordem_menu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo Menu') ?></th>
            <td><?= $menu->ativo_menu ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
