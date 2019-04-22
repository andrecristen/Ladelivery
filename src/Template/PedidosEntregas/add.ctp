<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PedidosEntrega $pedidosEntrega
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedidosEntrega) ?>
    <fieldset>
        <legend><?= __('Adicionar Pedido Entrega') ?></legend>
        <?php
            echo $this->Form->control('pedido_id', ['options' => $pedidos]);
            echo $this->Form->control('valor_entrega');
            echo $this->Form->control('cotacao_maps');
            echo $this->Form->control('endereco_id', ['options' => $enderecos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
