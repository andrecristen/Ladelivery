<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conta $conta
 */
?>
<div class="col-sm-12">
    <h3><?= h($conta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $conta->has('user') ? $this->Html->link($conta->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $conta->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pessoa') ?></th>
            <td><?= h($conta->pessoa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descricao') ?></th>
            <td><?= h($conta->descricao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($conta->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= $this->Number->format($conta->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Total') ?></th>
            <td><?= $this->Number->format($conta->valor_total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Pagamento') ?></th>
            <td><?= h($conta->data_pagamento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Vencimento') ?></th>
            <td><?= h($conta->data_vencimento) ?></td>
        </tr>
    </table>
</div>
