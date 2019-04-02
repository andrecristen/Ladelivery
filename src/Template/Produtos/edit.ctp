<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($produto,  ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Editar Produto') ?></legend>
        <?php
        $tableLocator = new \Cake\ORM\Locator\TableLocator();
        /** @var $midia \App\Model\Entity\Midia */
        $midia = $tableLocator->get('Midias')->find()->where(['id' => $produto->midia_id])->first();
        echo $this->Form->control('nome_produto', ['label' => 'Nome']);
        echo $this->Form->control('categorias_produto_id', ['options' => $categoriasProdutos, 'label' => 'Categoria', 'required' => 'required']);
        echo $this->Form->control('descricao_produto', ['label' => 'Descrição', 'required' => 'required']);
        echo $this->Form->control('preco_produto', ['label' => 'Preço', 'required' => 'required']);
        echo $this->Form->control('ativo_produto', ['label' => 'Ativo']);
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
