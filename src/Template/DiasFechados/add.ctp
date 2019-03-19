<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DiasFechado $diasFechado
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($diasFechado) ?>
    <fieldset>
        <legend><?= __('Adicionar Dia Fechado') ?></legend>
        <div class="input date required">
            <label>Dia Fechado</label>
            <input name="dia_fechado" id="dia_fechado" type="date">
        </div>
        <?php
            echo $this->Form->control('motivo_fechado');
            echo $this->Form->control('empresa_id', ['options' => $empresas]);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
