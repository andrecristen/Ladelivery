<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Banner $banner
 */
?>
<div class="col-sm-12">
    <h3><?= h($banner->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($banner->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midia') ?></th>
            <td><?= $banner->has('midia') ? $this->Html->link($banner->midia->id, ['controller' => 'Midias', 'action' => 'view', $banner->midia->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Banner') ?></th>
            <td><?= h($banner->nome_banner) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= $banner->ativo ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
</div>
