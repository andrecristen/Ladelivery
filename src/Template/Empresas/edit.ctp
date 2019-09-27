<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($empresa) ?>
    <fieldset>
        <legend><?= __('Editar Empresa') ?></legend>
    </fieldset>
    <div class="tab">
        <button type="button" id="initialTabModal" class="tablinks" onclick="openTab(event, 'geral')">Geral</button>
        <button type="button" class="tablinks" onclick="openTab(event, 'contatos')">Contatos</button>
        <button type="button" class="tablinks" onclick="openTab(event, 'frete')">Configurações</button>
    </div>
    <div id="geral" class="tabcontent">
        <?php
        echo $this->Form->control('nome_fantasia');
        echo $this->Form->control('cnpj', ['class' => 'cnpj']);
        echo $this->Form->control('ie');
        echo $this->Form->control('tipo_empresa', ['options' => \App\Model\Entity\Empresa::getTipoList()]);
        echo $this->Form->control('ativa');
        ?>
        <br/>
    </div>
    <div id="contatos" style="height: 550px" class="tabcontent">
        <fieldset>
            <div ng-app="web-app">
                <script type="text/ng-template" id="contatos.html">
                    <?php echo $this->Form->control('tipo_contato', ['ng-model' => 'tipo_contato', 'options' => \App\Model\Entity\Empresa::getTipoContatoList()]);?>
                    <?php echo $this->Form->control('valor_contato', ['ng-model' => 'valor_contato']);?>
                </script>
                <ui-grid-form list='<?= $empresa->contatos ?>' ng-model="contatos" title="Contatos"></ui-grid-form>
            </div>
        </fieldset>
    </div>
    <div id="frete" class="tabcontent">
        <fieldset>
            <?php
            echo $this->Form->control('user_id', ['options' => $users, 'required'=>'required', 'label' => 'Usuário']);
            echo $this->Form->control('tipo_frete', ['options' => \App\Model\Entity\Empresa::getTipoFreteList()]);
            echo $this->Form->control('valor_base_erro_frete');
            ?>
            <br/>
        </fieldset>
    </div>
    <br>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
