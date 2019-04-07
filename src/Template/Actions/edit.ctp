<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Action $action
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($action) ?>
    <fieldset>
        <legend><?= __('Editar Action') ?></legend>
        <?php
        echo $this->Form->control('controller_id', ['options' => $controllers]);
        echo $this->Form->control('nome_action');
        echo $this->Form->control('descricao_action');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
