<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TemposMedio $temposMedio
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tempos Medio'), ['action' => 'edit', $temposMedio->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tempos Medio'), ['action' => 'delete', $temposMedio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $temposMedio->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tempos Medios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tempos Medio'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="temposMedios view large-9 medium-8 columns content">
    <h3><?= h($temposMedio->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($temposMedio->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($temposMedio->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Empresa Id') ?></th>
            <td><?= $this->Number->format($temposMedio->empresa_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tempo Medio Producao Minutos') ?></th>
            <td><?= $this->Number->format($temposMedio->tempo_medio_producao_minutos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= $temposMedio->ativo ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
