<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PedidosEntrega $pedidosEntrega
 */
?>
<div class="col-sm-12">
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
