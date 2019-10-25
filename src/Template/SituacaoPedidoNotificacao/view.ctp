<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SituacaoPedidoNotificacao $situacaoPedidoNotificacao
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Situacao Pedido Notificacao'), ['action' => 'edit', $situacaoPedidoNotificacao->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Situacao Pedido Notificacao'), ['action' => 'delete', $situacaoPedidoNotificacao->id], ['confirm' => __('Are you sure you want to delete # {0}?', $situacaoPedidoNotificacao->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Situacao Pedido Notificacao'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Situacao Pedido Notificacao'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="situacaoPedidoNotificacao view large-9 medium-8 columns content">
    <h3><?= h($situacaoPedidoNotificacao->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($situacaoPedidoNotificacao->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Situacao Pedido') ?></th>
            <td><?= $this->Number->format($situacaoPedidoNotificacao->situacao_pedido) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Template Titulo') ?></h4>
        <?= $this->Text->autoParagraph(h($situacaoPedidoNotificacao->template_titulo)); ?>
    </div>
    <div class="row">
        <h4><?= __('Template Mensagem') ?></h4>
        <?= $this->Text->autoParagraph(h($situacaoPedidoNotificacao->template_mensagem)); ?>
    </div>
</div>
