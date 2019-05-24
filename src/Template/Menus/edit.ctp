<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $menu->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Modulos'), ['controller' => 'Modulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Modulo'), ['controller' => 'Modulos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menus form large-9 medium-8 columns content">
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __('Edit Menu') ?></legend>
        <?php
            echo $this->Form->control('modulo_id', ['options' => $modulos]);
            echo $this->Form->control('action_id', ['options' => $actions]);
            echo $this->Form->control('nome_menu');
            echo $this->Form->control('ativo_menu');
            echo $this->Form->control('ordem_menu');
            echo $this->Form->control('icon_menu');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
