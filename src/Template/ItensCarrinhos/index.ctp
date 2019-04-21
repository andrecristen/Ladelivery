<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItensCarrinho[]|\Cake\Collection\CollectionInterface $itensCarrinhos
 */
?>

<div class="col-sm-12">
    <h3><?= __('Itens Carrinhos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($itensCarrinhos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'ItensCarrinhos/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Usuário', 'user/nome_completo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Produto', 'produto/nome_produto', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Quantidade', 'quantidades', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor Cobrado', 'valor_total_cobrado', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Observação', 'observacao', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Adicionais', 'opicionais', \App\Model\Utils\DataGridGenerator::TYPE_JSON));
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->bloqActionAdd();
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
