<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Midia $midia
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($midia, ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Adicionar Midia') ?></legend>
        <?php
            echo $this->Form->control('nome_midia' ,['label' => 'Nome']);
            echo $this->Form->control('tipo_midia', ['options' => $tipoList, 'label' => 'Tipo']);
            echo '<label class="required" for="uploadfile">Imagem</label>';
            echo $this->Form->file('uploadfile', ['required'=>'required']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
