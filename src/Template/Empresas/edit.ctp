<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
 */
$configuracaoJson = json_encode($empresa->contatos);
?>
<div class="col-sm-12">
    <?= $this->Form->create($empresa) ?>
    <fieldset>
        <legend><?= __('Editar Empresa') ?></legend>
        <?php
        echo $this->Form->control('nome_fantasia');
        echo $this->Form->control('cnpj');
        echo $this->Form->control('ie');
        echo $this->Form->control('tipo_empresa', ['options' => \App\Model\Entity\Empresa::getTipoList()]);
        echo $this->Form->control('tipo_frete', ['options' => \App\Model\Entity\Empresa::getTipoFreteList()]);
        echo $this->Form->control('ativa');
        ?>
        <br/>
    </fieldset>
    <fieldset>
        <div ng-app="web-app">
            <script type="text/ng-template" id="contatos.html">
                <?php echo $this->Form->control('tipo_contato', ['ng-model' => 'tipo_contato', 'options' => \App\Model\Entity\Empresa::getTipoContatoList()]);?>
                <?php echo $this->Form->control('valor_contato', ['ng-model' => 'valor_contato']);?>
            </script>
            <ui-grid-form list='<?= $configuracaoJson ?>' ng-model="contatos" title="Contatos"></ui-grid-form>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
