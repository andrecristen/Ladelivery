<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProdutosImagen[]|\Cake\Collection\CollectionInterface $produtosImagens
 */
?>
<div class="col-sm-12">
    <h3><?= __('Produtos Imagens') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($produtosImagens);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#Produto', 'produto/id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'produtos/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Produto', 'produto/nome_produto', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Imagem', 'nome_imagem', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->bloqActionAdd();
    $dataGrid->hiddeActionsRows();
    $dataGrid->addAction('Produtos', 'addImage', 'Adicionar Imagem', 'btn btn-success');
    $dataGrid->display();
    ?>
</div>
