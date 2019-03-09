<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoogleMapsApiKey $googleMapsApiKey
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Google Maps Api Key'), ['action' => 'edit', $googleMapsApiKey->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Google Maps Api Key'), ['action' => 'delete', $googleMapsApiKey->id], ['confirm' => __('Are you sure you want to delete # {0}?', $googleMapsApiKey->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Google Maps Api Key'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Google Maps Api Key'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="googleMapsApiKey view large-9 medium-8 columns content">
    <h3><?= h($googleMapsApiKey->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $googleMapsApiKey->has('user') ? $this->Html->link($googleMapsApiKey->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $googleMapsApiKey->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Api Key') ?></th>
            <td><?= h($googleMapsApiKey->api_key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($googleMapsApiKey->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativa') ?></th>
            <td><?= $this->Number->format($googleMapsApiKey->ativa) ?></td>
        </tr>
    </table>
</div>
