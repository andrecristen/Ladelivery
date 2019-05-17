<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedido) ?>
    <fieldset>
        <legend>Definir Data Pagamento</legend>
        <?php
        echo $this->Form->label('data_pagamento', null, ['required' => true]);
        ?>
        <input name="data_pagamento" id="data_pagamento" type="date" required="required">
    </fieldset>
    <br />
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>