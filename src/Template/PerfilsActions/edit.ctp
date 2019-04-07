<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PerfilsAction $perfilsAction
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($perfilsAction) ?>
    <fieldset>
        <legend><?= __('Editar Relacionamento Perfil x Action') ?></legend>
        <?php
        echo $this->Form->control('action_id', ['options' => $actions]);
        echo $this->Form->control('perfil_id', ['options' => $perfils]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Editar')) ?>
    <?= $this->Form->end() ?>
</div>
