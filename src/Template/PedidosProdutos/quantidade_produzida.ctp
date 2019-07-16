<div class="col-sm-12">
    <?= $this->Form->create($pedidosProduto) ?>
    <fieldset>
        <legend><?= __('Alterar Quantidade Produzida Item #' .$pedidosProduto->id) ?></legend>
        <?php
        echo $this->Form->control('quantidade', ['disabled']);
        echo $this->Form->control('quantidade_produzida');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>