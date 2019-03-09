<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PedidosEntrega[]|\Cake\Collection\CollectionInterface $pedidosEntregas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pedidos Entrega'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Enderecos'), ['controller' => 'Enderecos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Endereco'), ['controller' => 'Enderecos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pedidosEntregas index large-9 medium-8 columns content">
    <h3><?= __('Pedidos Entregas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pedido_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valor_entrega') ?></th>
                <th scope="col"><?= $this->Paginator->sort('endereco_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidosEntregas as $pedidosEntrega): ?>
            <tr>
                <td><?= $this->Number->format($pedidosEntrega->id) ?></td>
                <td><?= $pedidosEntrega->has('pedido') ? $this->Html->link($pedidosEntrega->pedido->id, ['controller' => 'Pedidos', 'action' => 'view', $pedidosEntrega->pedido->id]) : '' ?></td>
                <td><?= $this->Number->format($pedidosEntrega->valor_entrega) ?></td>
                <td><?= $pedidosEntrega->has('endereco') ? $this->Html->link($pedidosEntrega->endereco->id, ['controller' => 'Enderecos', 'action' => 'view', $pedidosEntrega->endereco->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pedidosEntrega->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pedidosEntrega->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pedidosEntrega->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pedidosEntrega->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
