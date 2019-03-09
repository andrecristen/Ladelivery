<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProdutosImagen[]|\Cake\Collection\CollectionInterface $produtosImagens
 */
?>
<div class="col-sm-12">
    <h3><?= __('Produtos Imagens') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($produtosImagens);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('Produto', 'produto_id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Imagem', 'nome_imagem', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->bloqActionAdd();
    $dataGrid->hiddeActionsRows();
    $dataGrid->addAction('Produtos', 'addImage', 'Adicionar Imagem', 'btn btn-success');
    $dataGrid->display();
    ?>
</div>
