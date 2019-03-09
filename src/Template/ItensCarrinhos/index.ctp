<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItensCarrinho[]|\Cake\Collection\CollectionInterface $itensCarrinhos
 */
?>

<div class="col-sm-12">
    <h3><?= __('Itens Carrinhos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($itensCarrinhos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Usuário', 'user/nome_completo', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Produto', 'produto/nome_produto', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Quantidade', 'quantidades', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->addField('Valor Cobrado', 'valor_total_cobrado', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->addField('Observação', 'observacao', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->addField('Adicionais', 'opicionais', \App\Model\Utils\DataGridLaDev::TYPE_JSON);
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->bloqActionAdd();
    $dataGrid->display();
    ?>
</div>
