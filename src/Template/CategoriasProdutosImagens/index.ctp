<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriasProdutosImagen[]|\Cake\Collection\CollectionInterface categoriasProdutosImagens
 */
?>
<div class="col-sm-12">
    <h3><?= __('Categorias Imagens') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setModel($categoriasProdutosImagens);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('Categoria', 'categorias_produto_id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Imagem', 'nome_imagem', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->bloqActionAdd();
    $dataGrid->hiddeActionsRows();
    $dataGrid->addAction('CategoriasProdutos', 'addImage', 'Adicionar Imagem', 'btn btn-success');
    $dataGrid->display();
    ?>
</div>
