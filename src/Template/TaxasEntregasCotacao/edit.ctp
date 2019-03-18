<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaxasEntregasCotacao $taxasEntregasCotacao
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($taxasEntregasCotacao) ?>
    <fieldset>
        <legend><?= __('Editar Taxas Entregas Cotacao') ?></legend>
        <?php
        echo $this->Form->control('valor_km');
        echo $this->Form->control('arredondamento_tipo', ['options' => $taxasEntregasCotacao->getListTipoArredondamento(), 'required'=>'required']);
        echo $this->Form->control('ativo');
        echo $this->Form->control('valor_base_erro', ['required'=>'required']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>