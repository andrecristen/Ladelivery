<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($produto, ['type' => 'file']) ?>
    <div class="tab">
        <button type="button" id="initialTabModal" class="tablinks" onclick="openTab(event, 'geral')">Geral</button>
        <button type="button" class="tablinks" onclick="openTab(event, 'listas')">Listas</button>
    </div>
    <div id="geral" class="tabcontent">
        <fieldset>
            <legend><?= __('Adicionar Produto') ?></legend>
            <?php
            echo $this->Form->control('nome_produto', ['label' => 'Nome']);
            echo $this->Form->control('categorias_produto_id', ['options' => $categoriasProdutos, 'label' => 'Categoria', 'required' => 'required']);
            echo $this->Form->control('descricao_produto', ['label' => 'Descrição', 'required' => 'required']);
            echo $this->Form->control('preco_produto', ['label' => 'Preço', 'required' => 'required']);
            echo $this->Form->control('ativo_produto', ['label' => 'Ativo']);
            echo '<br />';
            echo '<label for="uploadfile">Imagem</label>';
            echo $this->Form->file('uploadfile');
            ?>
        </fieldset>
        <br/>
    </div>

    <div id="listas" style="height: 550px" class="tabcontent">
        <div ng-app="web-app">
            <script type="text/ng-template" id="listas.html">
                <select name="listas" ng-model="lista" ng-required="true">
                    <?php foreach ($listas as $key => $option) {
                        echo '<option ng-value="' . $key . '">' . $option . '</option>';
                    } ?>
                </select>
            </script>
            <ui-grid-form ng-model="listas" title="Listas para o Produto"></ui-grid-form>
        </div>
    </div>
    <br/>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>