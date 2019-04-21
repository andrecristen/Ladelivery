<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lista $lista
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($lista) ?>
    <fieldset>
        <legend><?= __('Adicionar Lista') ?></legend>
    </fieldset>
    <div class="tab">
        <button type="button" id="initialTabModal" class="tablinks" onclick="openTab(event, 'geral')">Geral</button>
        <button type="button" class="tablinks" onclick="openTab(event, 'adicionais')">Adicionais</button>
    </div>
    <div id="geral" class="tabcontent">

            <?php
            echo $this->Form->control('nome_lista', ['label' => 'Nome']);
            echo $this->Form->control('descricao_lista', ['label' => 'Descrição']);
            echo $this->Form->control('titulo_lista', ['label' => 'Título']);
            echo $this->Form->control('max_opcoes_selecionadas_lista', ['label' => 'Máximo opções selecionaveis']);
            echo $this->Form->control('min_opcoes_selecionadas_lista', ['label' => 'Minimo opções selecionaveis']);
            ?>
    </div>
    <div id="adicionais" style="height: 550px" class="tabcontent">
        <div ng-app="web-app">
            <script type="text/ng-template" id="adicionais.html">
                <select name="adicional" ng-model="adicional" ng-required="true">
                    <?php foreach ($opcoesExtras as $key => $option) {
                        echo '<option ng-value="' . $key . '">' . $option . '</option>';
                    } ?>
                </select>
                <div class="input checkbox">
                    <input type="hidden" name="ativo" value="0">
                    <label for="ativo">
                        <input type="checkbox" name="ativo" ng-model="ativo">Ativo
                    </label>
                </div>
            </script>
            <ui-grid-form ng-model="adicionais" title="Adicionais da lista"></ui-grid-form>
        </div>
    </div>
    <br/>
    <br/>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>