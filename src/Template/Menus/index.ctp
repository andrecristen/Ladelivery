<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu[]|\Cake\Collection\CollectionInterface $menus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Modulos'), ['controller' => 'Modulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Modulo'), ['controller' => 'Modulos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menus index large-9 medium-8 columns content">
    <h3><?= __('Menus') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modulo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('action_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nome_menu') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ativo_menu') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ordem_menu') ?></th>
                <th scope="col"><?= $this->Paginator->sort('icon_menu') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menus as $menu): ?>
            <tr>
                <td><?= $this->Number->format($menu->id) ?></td>
                <td><?= $menu->has('modulo') ? $this->Html->link($menu->modulo->id, ['controller' => 'Modulos', 'action' => 'view', $menu->modulo->id]) : '' ?></td>
                <td><?= $menu->has('action') ? $this->Html->link($menu->action->descricao_action, ['controller' => 'Actions', 'action' => 'view', $menu->action->id]) : '' ?></td>
                <td><?= h($menu->nome_menu) ?></td>
                <td><?= h($menu->ativo_menu) ?></td>
                <td><?= $this->Number->format($menu->ordem_menu) ?></td>
                <td><?= h($menu->icon_menu) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $menu->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menu->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
