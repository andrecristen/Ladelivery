<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AlteracaoSenha $alteracaoSenha
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($alteracaoSenha) ?>
    <fieldset>
        <legend><?= __('Alterar Senha') ?></legend>
        <?php
        echo $this->Form->control('senha', ['type'=> 'password', 'required' => 'required']);
        echo $this->Form->control('confirmar', ['type'=> 'password', 'required' => 'required']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>