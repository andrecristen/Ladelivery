<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnderecosEmpresa $enderecosEmpresa
 */
?>
<div class="col-sm-12">
    <h3><?= h($enderecosEmpresa->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($enderecosEmpresa->id) ?></td>
        </tr>
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
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= $this->Number->format($enderecosEmpresa->numero) ?></td>
        </tr>
    </table>
</div>
