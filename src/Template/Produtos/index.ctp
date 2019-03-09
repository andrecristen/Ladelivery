<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto[]|\Cake\Collection\CollectionInterface $produtos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Produtos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($produtos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Nome', 'nome_produto', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Categoria', 'categorias_produto/nome_categoria', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Ativo', 'ativo_produto', \App\Model\Utils\DataGridLaDev::TYPE_BOOLEAN);
    $dataGrid->addField('Criado', 'created', \App\Model\Utils\DataGridLaDev::TYPE_DATE);
    $dataGrid->addField('Editado', 'modified', \App\Model\Utils\DataGridLaDev::TYPE_DATE);
    $dataGrid->display();
    ?>
</div>
