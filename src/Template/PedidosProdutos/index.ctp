<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PedidosProduto[]|\Cake\Collection\CollectionInterface $pedidosProdutos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pedidos Produto'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pedido'), ['controller' => 'Pedidos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Produtos'), ['controller' => 'Produtos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Produto'), ['controller' => 'Produtos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pedidosProdutos index large-9 medium-8 columns content">
    <h3><?= __('Pedidos Produtos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pedido_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('produto_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantidade') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valor_total_cobrado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('opcionais') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ambiente_producao_responsavel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidosProdutos as $pedidosProduto): ?>
            <tr>
                <td><?= $this->Number->format($pedidosProduto->id) ?></td>
                <td><?= $pedidosProduto->has('pedido') ? $this->Html->link($pedidosProduto->pedido->id, ['controller' => 'Pedidos', 'action' => 'view', $pedidosProduto->pedido->id]) : '' ?></td>
                <td><?= $pedidosProduto->has('produto') ? $this->Html->link($pedidosProduto->produto->nome_produto, ['controller' => 'Produtos', 'action' => 'view', $pedidosProduto->produto->id]) : '' ?></td>
                <td><?= $this->Number->format($pedidosProduto->quantidade) ?></td>
                <td><?= $this->Number->format($pedidosProduto->valor_total_cobrado) ?></td>
                <td><?= h($pedidosProduto->observacao) ?></td>
                <td><?= h($pedidosProduto->opcionais) ?></td>
                <td><?= $this->Number->format($pedidosProduto->ambiente_producao_responsavel) ?></td>
                <td><?= $this->Number->format($pedidosProduto->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pedidosProduto->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pedidosProduto->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pedidosProduto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pedidosProduto->id)]) ?>
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
