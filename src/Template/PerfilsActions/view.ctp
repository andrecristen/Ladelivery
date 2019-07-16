<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PerfilsAction $perfilsAction
 */
?>
<div class="col-sm-12">
    <h3>Perfil x Action #<?= h($perfilsAction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($perfilsAction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $perfilsAction->has('action') ? $this->Html->link($perfilsAction->action->descricao_action, ['controller' => 'Actions', 'action' => 'view', $perfilsAction->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Perfil') ?></th>
            <td><?= $perfilsAction->has('perfil') ? $this->Html->link($perfilsAction->perfil->nome_perfil, ['controller' => 'Perfils', 'action' => 'view', $perfilsAction->perfil->id]) : '' ?></td>
        </tr>
    </table>
</div>
