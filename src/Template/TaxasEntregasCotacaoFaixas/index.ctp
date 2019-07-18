<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaxasEntregasCotacaoFaixa[]|\Cake\Collection\CollectionInterface $taxasEntregasCotacaoFaixas
 */
?>
<div class="col-sm-12">
    <h3><?= __('Taxas Entregas Cotação Faixas') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($taxasEntregasCotacaoFaixas);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, false, false));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('KM Ínicio', 'kilometro_inicio', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('KM Fim', 'kilometro_fim', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor', 'valor', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'ativo', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));$dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
