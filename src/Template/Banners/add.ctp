<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Banner $banner
 */
?>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>Para banners só são aceitas imagens com resolução igual a 1200x400 pixels, resoluções diferentes serão bloqueadas no cadastro.</span>
    </div>
    <?= $this->Form->create($banner,  ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Adicionar Banner') ?></legend>
        <?php
        echo $this->Form->control('nome_banner');
        echo $this->Form->control('ativo');
        echo '<br />';
        echo '<label for="uploadfile">Imagem</label>';
        echo $this->Form->file('uploadfile', ['required' => 'required']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
