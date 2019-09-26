<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
?>
<div class="col-sm-12">
    <?= $this->Html->script('pedido.js' . $cacheVersion); ?>
    <?= $this->Form->create($pedido) ?>
    <fieldset>
        <?php if ($isComanda){
            echo '<legend>Abrir Comanda</legend>';
            echo $this->Form->control('cliente', ['label'=> 'Cliente', 'required' => 'required']);
        }else{
            echo '<legend>Abrir Pedido</legend>';
            echo '<br>';
            echo '<div class="form-check">
                    <input onchange="alternateFieldsCliente(this)" type="checkbox" checked class="form-check-input" id="cliente">&nbsp;
                    <label class="form-check-label" for="cliente">Cliente com conta cadastrada</label>
                  </div>';
            echo $this->Form->control('user_id', ['id' => 'cliente_cadastrado', 'label'=> 'Cliente', 'options' => $users, 'required' => 'required']);
            echo $this->Form->control('cliente', ['id' => 'cliente_nao_cadastrado', 'disabled' => 'disabled', 'label'=> 'Cliente Não cadastrado', 'required' => 'required']);
            echo $this->Form->control('formas_pagamento_id', ['label'=> 'Forma Pagamento', 'options' => $formasPagamento, 'required' => 'required']);
        } ?>

    </fieldset>
    <br />
    <?= $this->Form->button(__('Abrir')) ?>
    <?= $this->Form->end() ?>
</div>
