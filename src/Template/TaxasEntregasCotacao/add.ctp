<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaxasEntregasCotacao $taxasEntregasCotacao
 */
?>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>
              Atenção! Ao cadastrar uma taxa de entrega como ativa caso no sistema já constar alguma ativa a anterior
              será desativada e a nova mantida como ativa. Isso porque só podemos ter uma taxa de entrega ativa.
              Certifique-se de sempre manter um cadastro como ativo, pois do contrario o sistema pode não
              funcionar corretamente.
        </span>
    </div>
    <?= $this->Form->create($taxasEntregasCotacao) ?>
    <fieldset>
        <legend><?= __('Adicionar Taxas Entregas Cotacao') ?></legend>
        <?php
        echo $this->Form->control('valor_km');
        echo $this->Form->control('arredondamento_tipo', ['options' => \App\Model\Entity\TaxasEntregasCotacao::getListTipoArredondamento(), 'required' => 'required']);
        echo $this->Form->control('ativo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
