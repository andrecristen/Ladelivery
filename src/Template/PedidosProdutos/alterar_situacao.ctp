<?php
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedidoProduto) ?>
    <fieldset>
        <legend><?= __('Alterar Situacao') ?></legend>
        <?php
        echo $this->Form->control('status', ['options' => $options]);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
