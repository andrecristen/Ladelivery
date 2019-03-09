<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListasOpcoesExtra $listasOpcoesExtra
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($listasOpcoesExtra) ?>
    <fieldset>
        <legend><?= __('Editar Relaxionamento Listas Opções X Extra') ?></legend>
        <?php
            echo $this->Form->control('lista_id', ['options' => $listas, 'required'=>'required']);
            echo $this->Form->control('opcoes_extra_id', ['options' => $opcoesExtras, 'required'=>'required', 'label'=>'Adicional']);
            echo $this->Form->control('ativa');
        ?>
    </fieldset>
    <br />
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
