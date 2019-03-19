<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Editar Usuário') ?></legend>
        <?php
        echo $this->Form->control('nome_completo');
        echo $this->Form->control('tipo', ['options'=> $list]);
        echo $this->Form->control('apelido');
        ?>
    </fieldset>
    <fieldset>
        <legend>Dados login</legend>
        <?php
        echo $this->Form->control('login',['type'=>'email']);
        ?>
    </fieldset>
    <fieldset>
        <legend>Nascimento</legend>
        <?php
        echo $this->Form->control('dia_nascimento', ['label'=>'Dia']);
        echo $this->Form->control('mes_nascimento', ['label'=>'Mês']);
        echo $this->Form->control('ano_nascimento', ['label'=>'Ano']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
