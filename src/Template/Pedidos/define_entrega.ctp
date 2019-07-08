<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedido) ?>
    <div class="alert alert-info">
        <span>Caso você não preencha o campo valor, o sistema irá calcular automaticamente com base no endereço de entrega.</span>
    </div>
    <fieldset>
        <legend>Entrega do Pedido</legend>
        <?php
        echo $this->Form->control('id', ['label' => 'Pedido', 'disabled' => 'disabled', 'type' => 'text', 'required' => false]);
        echo $this->Form->control('user_id', ['label' => 'Cliente', 'options' => $users, 'disabled' => 'disabled']);
        echo $this->Form->control('endereco_id', ['label' => 'Endereço', 'options' => $enderecosCliente, 'required' => true]);
        echo $this->Form->control('valor_entrega', ['label' => 'Valor', 'required' => false, 'type' => 'number']);
        ?>

    </fieldset>
    <br/>
    <?= $this->Form->button(__('Definir Entrega')) ?>
    <?= $this->Form->end() ?>
</div>
