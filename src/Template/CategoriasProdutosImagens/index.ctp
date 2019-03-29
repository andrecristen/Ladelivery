<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriasProdutosImagen[]|\Cake\Collection\CollectionInterface categoriasProdutosImagens
 */
?>
<div class="col-sm-12">
    <h3><?= __('Categorias Imagens') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($categoriasProdutosImagens);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#Categoria', 'categorias_produto/id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Categoria', 'categorias_produto/nome_categoria', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Imagem', 'nome_imagem', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->bloqActionAdd();
    $dataGrid->hiddeActionsRows();
    $dataGrid->addAction('CategoriasProdutos', 'addImage', 'Adicionar Imagem', 'btn btn-success');
    $dataGrid->display();
    ?>
</div>
