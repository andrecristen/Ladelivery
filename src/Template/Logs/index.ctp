<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log[]|\Cake\Collection\CollectionInterface $logs
 */
?>
<div class="col-sm-12">
    <h3><?= __('Notificações') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->setModel($logs);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'logs/id'));
    $tipoList = new \App\Model\Utils\GridField('Tipo', 'tipo', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $tipoList->setList(\App\Model\Entity\Log::getTipoList());
    //$dataGrid->addField($tipoList);
    $dataGrid->addField(new \App\Model\Utils\GridField('#Cliente', 'user/id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Cliente', 'user/nome_completo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Data Hora', 'data_hora', \App\Model\Utils\DataGridGenerator::TYPE_DATE_TIME));
    $situacaoList = new \App\Model\Utils\GridField('Situação', 'situacao', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $situacaoList->setList(\App\Model\Entity\Log::getSituacaoList());
    $dataGrid->addField($situacaoList);
    $dataGrid->bloqActionAdd();
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
