<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Endereco $endereco
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($endereco) ?>
    <fieldset>
        <legend><?= __('Editar Endereço') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'required'=>'required']);
            echo $this->Form->control('rua');
            echo $this->Form->control('numero');
            echo $this->Form->control('bairro');
            echo $this->Form->control('cidade');
            echo $this->Form->control('cep');
            echo $this->Form->control('complemento');
            echo $this->Form->control('estado', ['options' => $endereco->getEstados()]);
        ?>
        <br/>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
