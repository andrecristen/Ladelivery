<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Controller $controller
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($controller) ?>
    <fieldset>
        <legend><?= __('Editar Controller') ?></legend>
        <?php
        echo $this->Form->control('nome_controlador');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
