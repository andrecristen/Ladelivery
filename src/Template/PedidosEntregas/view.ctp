<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PedidosEntrega $pedidosEntrega
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pedidos Entrega'), ['action' => 'edit', $pedidosEntrega->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pedidos Entrega'), ['action' => 'delete', $pedidosEntrega->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pedidosEntrega->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pedidos Entregas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pedidos Entrega'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Enderecos'), ['controller' => 'Enderecos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Endereco'), ['controller' => 'Enderecos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pedidosEntregas view large-9 medium-8 columns content">
    <h3><?= h($pedidosEntrega->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Pedido') ?></th>
            <td><?= $pedidosEntrega->has('pedido') ? $this->Html->link($pedidosEntrega->pedido->id, ['controller' => 'Pedidos', 'action' => 'view', $pedidosEntrega->pedido->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Endereco') ?></th>
            <td><?= $pedidosEntrega->has('endereco') ? $this->Html->link($pedidosEntrega->endereco->id, ['controller' => 'Enderecos', 'action' => 'view', $pedidosEntrega->endereco->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pedidosEntrega->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Entrega') ?></th>
            <td><?= $this->Number->format($pedidosEntrega->valor_entrega) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Cotacao Maps') ?></h4>
        <?= $this->Text->autoParagraph(h($pedidosEntrega->cotacao_maps)); ?>
    </div>
</div>
