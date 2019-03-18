<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HorariosAtendimento $horariosAtendimento
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($horariosAtendimento) ?>
    <fieldset>
        <legend><?= __('Editar Horarios Atendimento') ?></legend>
        <?php
            echo $this->Form->control('empresa_id', ['options' => $empresas]);
            echo $this->Form->control('dia_semana', ['options' => \App\Model\Entity\HorariosAtendimento::getDiaSemanaList()]);
            echo $this->Form->control('turno', ['options' => \App\Model\Entity\HorariosAtendimento::getTurnoList()]);
            echo $this->Form->control('hora_inicio', ['label' => 'Inicio']);
            echo $this->Form->control('hora_fim', ['label' => 'Fim']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
