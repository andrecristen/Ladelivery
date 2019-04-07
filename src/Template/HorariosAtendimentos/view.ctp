<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HorariosAtendimento $horariosAtendimento
 */
?>
<div class="col-sm-12">
    <h3><?= h($horariosAtendimento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Empresa') ?></th>
            <td><?= $horariosAtendimento->has('empresa') ? $this->Html->link($horariosAtendimento->empresa->nome_fantasia, ['controller' => 'Empresas', 'action' => 'view', $horariosAtendimento->empresa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($horariosAtendimento->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dia Semana') ?></th>
            <td><?= $this->Number->format($horariosAtendimento->dia_semana) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Turno') ?></th>
            <td><?= $this->Number->format($horariosAtendimento->turno) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hora Inicio') ?></th>
            <td><?= h($horariosAtendimento->hora_inicio->format('H:i:s')) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hora Fim') ?></th>
            <td><?= h($horariosAtendimento->hora_fim->format('H:i:s')) ?></td>
        </tr>
    </table>
</div>
