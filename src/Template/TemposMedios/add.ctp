<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TemposMedio $temposMedio
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($temposMedio) ?>
    <fieldset>
        <legend><?= __('Adicionar Tempo Produção') ?></legend>
        <?php
        echo $this->Form->control('empresa_id');
        echo $this->Form->control('nome');
        echo $this->Form->control('tempo_medio_producao_minutos');
        echo $this->Form->control('ativo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
