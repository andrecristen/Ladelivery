<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Banner $banner
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Banner'), ['action' => 'edit', $banner->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Banner'), ['action' => 'delete', $banner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $banner->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Banners'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Banner'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Midias'), ['controller' => 'Midias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Midia'), ['controller' => 'Midias', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="banners view large-9 medium-8 columns content">
    <h3><?= h($banner->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Midia') ?></th>
            <td><?= $banner->has('midia') ? $this->Html->link($banner->midia->id, ['controller' => 'Midias', 'action' => 'view', $banner->midia->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($banner->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Banner') ?></th>
            <td><?= $this->Number->format($banner->nome_banner) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= $banner->ativo ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
