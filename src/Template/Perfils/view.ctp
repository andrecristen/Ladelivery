<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Perfil $perfil
 */
?>
<div class="col-sm-12">
    <h3>Perfil #<?= h($perfil->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($perfil->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Perfil') ?></th>
            <td><?= h($perfil->nome_perfil) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Padrao Novos Users') ?></th>
            <td><?= $perfil->padrao_novos_users ? __('Sim') : __('Nao'); ?></td>
        </tr>
    </table>
</div>
