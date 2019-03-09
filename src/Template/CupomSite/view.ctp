<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CupomSite $cupomSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cupom Site'), ['action' => 'edit', $cupomSite->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cupom Site'), ['action' => 'delete', $cupomSite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cupomSite->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cupom Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cupom Site'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cupomSite view large-9 medium-8 columns content">
    <h3><?= h($cupomSite->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome Cupom') ?></th>
            <td><?= h($cupomSite->nome_cupom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cupomSite->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vezes Usado') ?></th>
            <td><?= $this->Number->format($cupomSite->vezes_usado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maximo Vezes Usar') ?></th>
            <td><?= $this->Number->format($cupomSite->maximo_vezes_usar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Desconto') ?></th>
            <td><?= $this->Number->format($cupomSite->valor_desconto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Porcentagem') ?></th>
            <td><?= $cupomSite->porcentagem ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
