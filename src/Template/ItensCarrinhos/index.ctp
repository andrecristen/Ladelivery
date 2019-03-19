<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItensCarrinho[]|\Cake\Collection\CollectionInterface $itensCarrinhos
 */
?>

<div class="col-sm-12">
    <h3><?= __('Itens Carrinhos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setModel($itensCarrinhos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Usuário', 'user/nome_completo', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Produto', 'produto/nome_produto', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Quantidade', 'quantidades', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Valor Cobrado', 'valor_total_cobrado', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Observação', 'observacao', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Adicionais', 'opicionais', \App\Model\Utils\DataGridUtils::TYPE_JSON);
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->bloqActionAdd();
    $dataGrid->display();
    ?>
</div>
