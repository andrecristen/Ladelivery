<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PedidosProduto $pedidosProduto
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedidosProduto) ?>
    <fieldset>
        <legend><?= __('Add Pedidos Produto') ?></legend>
        <?php
            echo $this->Form->control('pedido_id', ['options' => $pedidos]);
            echo $this->Form->control('produto_id', ['options' => $produtos]);
            echo $this->Form->control('quantidade');
            echo $this->Form->control('valor_total_cobrado');
            echo $this->Form->control('observacao');
            echo $this->Form->control('opcionais');
            echo $this->Form->control('ambiente_producao_responsavel');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
