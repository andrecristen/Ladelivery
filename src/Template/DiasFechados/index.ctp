<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DiasFechado[]|\Cake\Collection\CollectionInterface $diasFechados
 */
?>
<div class="col-sm-12">
    <h3><?= __('Dias Fechados') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->setModel($diasFechados);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Dia', 'dia_fechado', \App\Model\Utils\DataGridUtils::TYPE_DATE);
    $dataGrid->addField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Motivo', 'motivo_fechado', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->display();
    ?>
</div>
