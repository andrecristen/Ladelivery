<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TemposMedio $temposMedio
 */
?>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>
              Atenção! Ao cadastrar um tempo de produção como ativo caso no sistema já constar algum ativo o anterior
              será desativado e o novo mantido como ativo. Isso porque só podemos ter um tempo para cada tipo ativo.
              Certifique-se de sempre manter um cadastro para cada tipo ativo, pois do contrario o sistema pode não
              funcionar corretamente.
        </span>
    </div>
    <?= $this->Form->create($temposMedio) ?>
    <fieldset>
        <legend><?= __('Adicionar Tempo Produção') ?></legend>
        <?php
        echo $this->Form->control('nome');
        echo $this->Form->control('tipo', ['options' => \App\Model\Entity\TemposMedio::getTipoList()]);
        echo $this->Form->control('tempo_medio_producao_minutos');
        echo $this->Form->control('ativo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
