<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OpcoesExtra $opcoesExtra
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($opcoesExtra) ?>
    <fieldset>
        <legend><?= __('Editar Adicional') ?></legend>
        <?php
        echo $this->Form->control('nome_adicional', ['label'=> 'Nome']);
        echo $this->Form->control('descricao_adicional', ['label'=> 'Descrição']);
        echo $this->Form->control('valor_adicional', ['label'=> 'Valor']);
        ?>
    </fieldset>
    <br />
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
