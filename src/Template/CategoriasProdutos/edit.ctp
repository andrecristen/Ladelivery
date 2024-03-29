<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriasProduto $categoriasProduto
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($categoriasProduto, ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Editar Categoria') ?></legend>
        <?php
        $tableLocator = new \Cake\ORM\Locator\TableLocator();
        /** @var $midia \App\Model\Entity\Midia */
        $midia = $tableLocator->get('Midias')->find()->where(['id' => $categoriasProduto->midia_id])->first();
        echo $this->Form->control('nome_categoria', ['label' => 'Nome']);
        echo $this->Form->control('descricao_categoria', ['label' => 'Descrição']);
        echo '<br />';
        echo '<label for="uploadfile">Alterar Imagem:</label>';
        echo $this->Form->file('uploadfile');
        if ($midia) {
            echo '<label>Imagem Atual:</label>';
            echo '<br>';
            echo $this->Html->image($midia->path_midia);
        }
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
