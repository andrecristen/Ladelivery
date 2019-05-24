<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Modulo $modulo
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($modulo) ?>
    <fieldset>
        <legend><?= __('Editar Modulo') ?></legend>
        <?php
        echo $this->Form->control('nome');
        echo $this->Form->control('icon_class');
        echo $this->Form->control('ordem');
        echo $this->Form->control('ativo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
