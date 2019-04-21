<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaxasEntregasCotacao[]|\Cake\Collection\CollectionInterface $taxasEntregasCotacao
 */
?>
<div class="col-sm-12">
    <h3><?= __('Taxas Entregas Cotacao') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($taxasEntregasCotacao);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, false, false));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor por KM', 'valor_km', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $tipoArredondamento = new \App\Model\Utils\GridField('Tipo Arredondamento', 'arredondamento_tipo', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $tipoArredondamento->setList(\App\Model\Entity\TaxasEntregasCotacao::getListTipoArredondamentoConsulta());
    $dataGrid->addField($tipoArredondamento);
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'ativo', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor base em caso de erro', 'valor_base_erro', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
