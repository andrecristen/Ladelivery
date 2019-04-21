<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DiasFechado[]|\Cake\Collection\CollectionInterface $diasFechados
 */
?>
<div class="col-sm-12">
    <h3><?= __('Dias Fechados') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->setModel($diasFechados);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'DiasFechados/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Dia', 'dia_fechado', \App\Model\Utils\DataGridGenerator::TYPE_DATE));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Motivo', 'motivo_fechado', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
