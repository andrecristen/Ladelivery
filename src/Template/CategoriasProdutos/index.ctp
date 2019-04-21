<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriasProduto[]|\Cake\Collection\CollectionInterface $categoriasProdutos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Categorias Produtos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($categoriasProdutos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'categoriasProdutos/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_categoria', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Criado', 'created', \App\Model\Utils\DataGridGenerator::TYPE_DATE));
    $dataGrid->addField(new \App\Model\Utils\GridField('Editado', 'modified', \App\Model\Utils\DataGridGenerator::TYPE_DATE));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
