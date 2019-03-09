<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriasProduto $categoria
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($categoria, ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Adicionar Imagem Categoria') ?></legend>
        <?php
        echo $this->Form->control('categorias_produto_id', ['options' => $categorias, 'required'=>'required']);
        echo $this->Form->create(null, ['type' => 'file']);
        echo '<br />';
        echo '<label for="uploadfile">Imagem</label>';
        echo $this->Form->file('uploadfile', ['required'=>'required']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
