<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto[]|\Cake\Collection\CollectionInterface $produtos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Produtos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($produtos);
    $dataGrid->bloqActionDelete();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'produto/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_produto', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Categoria', 'categorias_produto/nome_categoria', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'ativo_produto', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->addField(new \App\Model\Utils\GridField('Criado', 'created', \App\Model\Utils\DataGridGenerator::TYPE_DATE_TIME, true, false, 'auto', 'produto/created'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Editado', 'modified', \App\Model\Utils\DataGridGenerator::TYPE_DATE_TIME,true, false, 'auto', 'produto/modified'));
    $dataGrid->setController($this->name);
    $dataGrid->addAction('ProgramarDesativarProdutos', 'index', 'Definir Dias Desativados', 'btn-success', 'fab fa-creative-commons-nc', null, 'Define em que dias da semana o produto não deve ser vendido');
    $dataGrid->display();
    ?>
</div>
