<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($produto, ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Adicionar Imagem Produto') ?></legend>
        <?php
        echo $this->Form->control('produto_id', ['options' => $produtos, 'required'=>'required']);
        echo $this->Form->create(null, ['type' => 'file']);
        echo '<br />';
        echo '<label for="uploadfile">Imagem</label>';
        echo $this->Form->file('uploadfile', ['required'=>'required']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
