<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PerfilsUser $perfilsUser
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($perfilsUser) ?>
    <fieldset>
        <legend><?= __('Editar Perfils User') ?></legend>
        <?php
        echo $this->Form->control('perfil_id', ['options' => $perfils]);
        echo $this->Form->control('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
