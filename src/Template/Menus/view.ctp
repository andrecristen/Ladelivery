<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<div class="col-sm-12">
    <h3>Menu #<?= h($menu->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modulo') ?></th>
            <td><?= $menu->has('modulo') ? $this->Html->link($menu->modulo->id, ['controller' => 'Modulos', 'action' => 'view', $menu->modulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $menu->has('action') ? $this->Html->link($menu->action->descricao_action, ['controller' => 'Actions', 'action' => 'view', $menu->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Menu') ?></th>
            <td><?= h($menu->nome_menu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Icon Menu') ?></th>
            <td><?= h($menu->icon_menu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordem Menu') ?></th>
            <td><?= $this->Number->format($menu->ordem_menu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo Menu') ?></th>
            <td><?= $menu->ativo_menu ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
