<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TemposMedio[]|\Cake\Collection\CollectionInterface $temposMedios
 */
?>
<div class="col-sm-12">
    <h3><?= __('Tempos Produção') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($temposMedios);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, false,false));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $tipo = new \App\Model\Utils\GridField('Tipo', 'tipo', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $tipo->setList(\App\Model\Entity\TemposMedio::getTipoList());
    $dataGrid->addField($tipo);
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Tempo em minutos', 'tempo_medio_producao_minutos', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'ativo', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>

