<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListasProduto[]|\Cake\Collection\CollectionInterface $listasProdutos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Listas X Produtos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($listasProdutos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'listasProdutos/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Produto', 'produto/nome_produto', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Lista', 'lista/nome_lista', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
