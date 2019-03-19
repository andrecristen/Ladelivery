<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DiasFechado $diasFechado
 */
?>
<div class="col-sm-12">
    <h3><?= h($diasFechado->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Motivo Fechado') ?></th>
            <td><?= h($diasFechado->motivo_fechado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($diasFechado->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dia Fechado') ?></th>
            <td><?= h($diasFechado->dia_fechado) ?></td>
        </tr>
    </table>
</div>