<?php
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedido) ?>
    <fieldset>
        <legend><?= __('Alterar Situacao') ?></legend>
        <?php
        if($pedido->tipo_pedido == \App\Model\Entity\Pedido::TIPO_PEDIDO_DELIVERY){
            echo $this->Form->control('status_pedido', ['options' => \App\Model\Entity\Pedido::getDeliveryAlterStatusList()]);
        }else{
            echo $this->Form->control('status_pedido', ['options' => \App\Model\Entity\Pedido::getComandaStatusList()]);
        }

        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
