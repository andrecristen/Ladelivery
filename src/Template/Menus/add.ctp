<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __('Adicionar Menu') ?></legend>
        <?php
            echo $this->Form->control('modulo_id', ['options' => $modulos]);
            echo $this->Form->control('action_id', ['options' => $actions]);
            echo $this->Form->control('nome_menu');
            echo $this->Form->control('ativo_menu');
            echo $this->Form->control('ordem_menu');
            echo $this->Form->control('icon_menu');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
