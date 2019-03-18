<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DiasFechado[]|\Cake\Collection\CollectionInterface $diasFechados
 */
?>
<div class="col-sm-12">
    <h3><?= __('Dias Fechados') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->setModel($diasFechados);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Dia', 'dia_fechado', \App\Model\Utils\DataGridLaDev::TYPE_DATE);
    $dataGrid->addField('Motivo', 'motivo_fechado', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->display();
    ?>
</div>
