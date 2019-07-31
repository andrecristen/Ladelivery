<?php
/**
 *
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedido) ?>
    <fieldset>
        <legend>Rejeitar Pedido #<?= $pedido->id?></legend>
        <?php
        echo $this->Form->control('id', ['label' => '#Pedido', 'disabled' => 'disabled']);
        echo $this->Form->control('user_id', ['label' => 'Cliente', 'options' => $users, 'disabled' => 'disabled']);
        echo $this->Form->control('motivo_rejeicao', ['label' => 'Motivo']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Rejeitar Pedido')) ?>
    <?= $this->Form->end() ?>
</div>
