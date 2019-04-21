<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HorariosAtendimento[]|\Cake\Collection\CollectionInterface $horariosAtendimentos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Horarios Atendimentos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->setModel($horariosAtendimentos);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'HorariosAtendimentos/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $diaSemana = new \App\Model\Utils\GridField('Dia Semana', 'dia_semana', \App\Model\Utils\DataGridGenerator::TYPE_LIST );
    $diaSemana->setList(\App\Model\Entity\HorariosAtendimento::getDiaSemanaList());
    $dataGrid->addField($diaSemana);
    $turno = new \App\Model\Utils\GridField('Turno', 'turno', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $turno->setList(\App\Model\Entity\HorariosAtendimento::getTurnoList());
    $dataGrid->addField($turno);
    $dataGrid->addField(new \App\Model\Utils\GridField('Inicio', 'hora_inicio', \App\Model\Utils\DataGridGenerator::TYPE_DATE_TIME));
    $dataGrid->addField(new \App\Model\Utils\GridField('Fim', 'hora_fim', \App\Model\Utils\DataGridGenerator::TYPE_DATE_TIME));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
