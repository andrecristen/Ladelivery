<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($produto,  ['type'=>'file']) ?>
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
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
