<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedido) ?>
    <fieldset>
        <?php if ($isComanda){
            echo '<legend>Abrir Comanda</legend>';
            echo $this->Form->control('cliente', ['label'=> 'Cliente', 'required' => 'required']);
        }else{
            echo '<legend>Abrir Pedido</legend>';
            echo $this->Form->control('user_id', ['label'=> 'Cliente', 'options' => $users, 'required' => 'required']);
            echo $this->Form->control('formas_pagamento_id', ['label'=> 'Forma Pagamento', 'options' => $formasPagamento, 'required' => 'required']);
        } ?>

    </fieldset>
    <br />
    <?= $this->Form->button(__('Abrir')) ?>
    <?= $this->Form->end() ?>
</div>
