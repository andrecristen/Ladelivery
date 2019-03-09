<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItensCarrinho $itensCarrinho
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Itens Carrinhos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Produtos'), ['controller' => 'Produtos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Produto'), ['controller' => 'Produtos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itensCarrinhos form large-9 medium-8 columns content">
    <?= $this->Form->create($itensCarrinho) ?>
    <fieldset>
        <legend><?= __('Add Itens Carrinho') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('produto_id', ['options' => $produtos]);
            echo $this->Form->control('quantidades');
            echo $this->Form->control('valor_total_cobrado');
            echo $this->Form->control('observacao');
            echo $this->Form->control('opicionais');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
