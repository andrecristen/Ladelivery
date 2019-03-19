<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HorariosAtendimento[]|\Cake\Collection\CollectionInterface $horariosAtendimentos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Horarios Atendimentos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->setModel($horariosAtendimentos);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Dia Semana', 'dia_semana', \App\Model\Utils\DataGridUtils::TYPE_LIST , \App\Model\Entity\HorariosAtendimento::getDiaSemanaList());
    $dataGrid->addField('Turno', 'turno', \App\Model\Utils\DataGridUtils::TYPE_LIST, \App\Model\Entity\HorariosAtendimento::getTurnoList());
    $dataGrid->addField('Inicio', 'hora_inicio', \App\Model\Utils\DataGridUtils::TYPE_DATE_TIME);
    $dataGrid->addField('Fim', 'hora_fim', \App\Model\Utils\DataGridUtils::TYPE_DATE_TIME);
    $dataGrid->display();
    ?>
</div>
