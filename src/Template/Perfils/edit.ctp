<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Perfil $perfil
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($perfil) ?>
    <fieldset>
        <legend><?= __('Editar Perfil') ?></legend>
        <?php
        echo $this->Form->control('nome_perfil');
        echo $this->Form->control('padrao_novos_users');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Editar')) ?>
    <?= $this->Form->end() ?>
</div>
