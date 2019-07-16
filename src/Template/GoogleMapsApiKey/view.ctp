<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoogleMapsApiKey $googleMapsApiKey
 */
?>
<div class="col-sm-12">
    <h3>Google Maps Api #<?= h($googleMapsApiKey->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($googleMapsApiKey->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $googleMapsApiKey->has('empresa') ? $this->Html->link($googleMapsApiKey->empresa->nome_fantasia, ['controller' => 'Empresas', 'action' => 'view', $googleMapsApiKey->empresa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Api Key') ?></th>
            <td><?= h($googleMapsApiKey->api_key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativa') ?></th>
            <td><?= $this->Number->format($googleMapsApiKey->ativa) ?></td>
        </tr>
    </table>
</div>
