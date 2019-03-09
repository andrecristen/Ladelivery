<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItensCarrinho $itensCarrinho
 */
?>
<div class="col-sm-12">
    <h3><?= h($itensCarrinho->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $itensCarrinho->has('user') ? $this->Html->link($itensCarrinho->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $itensCarrinho->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Produto') ?></th>
            <td><?= $itensCarrinho->has('produto') ? $this->Html->link($itensCarrinho->produto->nome_produto, ['controller' => 'Produtos', 'action' => 'view', $itensCarrinho->produto->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observacao') ?></th>
            <td><?= h($itensCarrinho->observacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Opicionais') ?></th>
            <td><?= h($itensCarrinho->opicionais) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itensCarrinho->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantidades') ?></th>
            <td><?= $this->Number->format($itensCarrinho->quantidades) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Total Cobrado') ?></th>
            <td><?= $this->Number->format($itensCarrinho->valor_total_cobrado) ?></td>
        </tr>
    </table>
</div>
