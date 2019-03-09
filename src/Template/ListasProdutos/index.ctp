<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListasProduto[]|\Cake\Collection\CollectionInterface $listasProdutos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Listas X Produtos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($listasProdutos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Produto', 'produto/nome_produto', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Lista', 'lista/nome_lista', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->display();
    ?>
</div>
