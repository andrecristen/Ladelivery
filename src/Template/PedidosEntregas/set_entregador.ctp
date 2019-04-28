<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PedidosEntrega $pedidosEntrega
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedidosEntrega) ?>
    <fieldset>
        <legend><?= __('Definir Entregador - Pedido Entrega') ?></legend>
        <?php
        echo $this->Form->control('pedido_id', ['options' => $pedidos, 'disabled' => true]);
        echo $this->Form->control('user_id', ['options' => $users]);
        echo $this->Form->control('valor_entrega', ['disabled' => true]);
        echo $this->Form->control('cotacao_maps', ['disabled' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
