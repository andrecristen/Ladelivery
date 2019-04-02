<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Midia $midia
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($midia, ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Editar Midia') ?></legend>
        <?php
        echo $this->Form->control('nome_midia' ,['label' => 'Nome']);
        echo $this->Form->control('tipo_midia', ['options' => $tipoList, 'label' => 'Tipo']);
        echo '<label class="required" for="uploadfile">Nova Imagem</label>';
        echo $this->Form->file('uploadfile', ['required'=>'false']);
        echo '<label>Imagem Atual</label>';
        echo '<br>';
        echo $this->Html->image($midia->path_midia);
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
