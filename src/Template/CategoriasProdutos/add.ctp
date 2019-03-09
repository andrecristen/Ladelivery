<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriasProduto $categoriasProduto
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($categoriasProduto) ?>
    <fieldset>
        <legend><?= __('Adicionar Categoria') ?></legend>
        <?php
            echo $this->Form->control('nome_categoria', ['label' => 'Nome']);
            echo $this->Form->control('descricao_categoria', ['label' => 'Descrição']);
        ?>
    </fieldset>
    <br />
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
