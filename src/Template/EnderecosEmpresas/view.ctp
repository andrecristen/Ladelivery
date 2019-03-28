<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnderecosEmpresa $enderecosEmpresa
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Enderecos Empresa'), ['action' => 'edit', $enderecosEmpresa->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Enderecos Empresa'), ['action' => 'delete', $enderecosEmpresa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enderecosEmpresa->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Enderecos Empresas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Enderecos Empresa'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Empresas'), ['controller' => 'Empresas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Empresa'), ['controller' => 'Empresas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="enderecosEmpresas view large-9 medium-8 columns content">
    <h3><?= h($enderecosEmpresa->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Empresa') ?></th>
            <td><?= $enderecosEmpresa->has('empresa') ? $this->Html->link($enderecosEmpresa->empresa->nome_fantasia, ['controller' => 'Empresas', 'action' => 'view', $enderecosEmpresa->empresa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rua') ?></th>
            <td><?= h($enderecosEmpresa->rua) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bairro') ?></th>
            <td><?= h($enderecosEmpresa->bairro) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cidade') ?></th>
            <td><?= h($enderecosEmpresa->cidade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($enderecosEmpresa->estado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cep') ?></th>
            <td><?= h($enderecosEmpresa->cep) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($enderecosEmpresa->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= $this->Number->format($enderecosEmpresa->numero) ?></td>
        </tr>
    </table>
</div>
