<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PerfilsUser $perfilsUser
 */
?>
<div class="col-sm-12">
    <h3>Perfil x User #<?= h($perfilsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($perfilsUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Perfil') ?></th>
            <td><?= $perfilsUser->has('perfil') ? $this->Html->link($perfilsUser->perfil->nome_perfil, ['controller' => 'Perfils', 'action' => 'view', $perfilsUser->perfil->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $perfilsUser->has('user') ? $this->Html->link($perfilsUser->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $perfilsUser->user->id]) : '' ?></td>
        </tr>
    </table>
</div>
