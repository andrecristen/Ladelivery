<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Modulo $modulo
 */
?>
<div class="col-sm-12">
    <h3>Módulo #<?= h($modulo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($modulo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($modulo->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Icon Class') ?></th>
            <td><?= h($modulo->icon_class) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordem') ?></th>
            <td><?= $this->Number->format($modulo->ordem) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= $modulo->ativo ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
