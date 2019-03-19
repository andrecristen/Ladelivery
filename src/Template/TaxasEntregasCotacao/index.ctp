<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaxasEntregasCotacao[]|\Cake\Collection\CollectionInterface $taxasEntregasCotacao
 */
?>
<div class="col-sm-12">
    <h3><?= __('Taxas Entregas Cotacao') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $listArredondamento = new \App\Model\Entity\TaxasEntregasCotacao();
    $dataGrid->setModel($taxasEntregasCotacao);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Valor por KM', 'valor_km', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Tipo Arredondamento', 'arredondamento_tipo', \App\Model\Utils\DataGridUtils::TYPE_LIST, $listArredondamento->getListTipoArredondamento());
    $dataGrid->addField('Ativo', 'ativo', \App\Model\Utils\DataGridUtils::TYPE_BOOLEAN);
    $dataGrid->addField('Valor base em caso de erro', 'valor_base_erro', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->display();
    ?>
</div>
