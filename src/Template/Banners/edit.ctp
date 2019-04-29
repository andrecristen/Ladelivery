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
        <legend><?= __('Editar Banner') ?></legend>
        <?php
        $tableLocator = new \Cake\ORM\Locator\TableLocator();
        /** @var $midia \App\Model\Entity\Midia */
        $midia = $tableLocator->get('Midias')->find()->where(['id' => $banner->midia_id])->first();
        echo $this->Form->control('nome_banner');
        echo $this->Form->control('ativo');
        echo '<br />';
        echo '<label for="uploadfile">Alterar Imagem:</label>';
        echo $this->Form->file('uploadfile');
        if ($midia) {
            echo '<label>Imagem Atual:</label>';
            echo '<br>';
            echo $this->Html->image($midia->path_midia);
        }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
