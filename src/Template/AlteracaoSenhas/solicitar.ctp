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
        echo $this->Form->control('email', ['type'=> 'email', 'required' => 'required']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Solicitar')) ?>
    <?= $this->Form->end() ?>
</div>