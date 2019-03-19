<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriasProduto[]|\Cake\Collection\CollectionInterface $categoriasProdutos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Categorias Produtos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setModel($categoriasProdutos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Nome', 'nome_categoria', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Criado', 'created', \App\Model\Utils\DataGridUtils::TYPE_DATE);
    $dataGrid->addField('Editado', 'modified', \App\Model\Utils\DataGridUtils::TYPE_DATE);
    $dataGrid->display();
    ?>
</div>
