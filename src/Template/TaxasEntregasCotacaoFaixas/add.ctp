<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaxasEntregasCotacaoFaixa $taxasEntregasCotacaoFaixa
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($taxasEntregasCotacaoFaixa) ?>
    <fieldset>
        <legend><?= __('Adicionar Taxas Entregas Cotação Faixa') ?></legend>
        <?php
            echo $this->Form->control('kilometro_inicio');
            echo $this->Form->control('kilometro_fim');
            echo $this->Form->control('valor');
            echo $this->Form->control('ativo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
