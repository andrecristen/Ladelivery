<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conta $conta
 */
?>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>Caso o destinatário for cadastrado, utilize o campo "Destinatário Cadastrado", caso contrário utilize o campo "Destinatário Não Cadastrado"!</span>
    </div>
    <?= $this->Form->create($conta) ?>
    <fieldset>
        <legend><?= __('Editar Conta') ?></legend>
        <?php
        echo $this->Form->control('tipo', ['options' => \App\Model\Entity\Conta::getTipoList()]);
        echo $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'label' => 'Destinatário Cadastrado']);
        echo $this->Form->control('pessoa', ['empty' => true, 'label' => 'Destinatário Não Cadastrado']);
        echo $this->Form->control('valor_total');
        echo $this->Form->control('descricao');
        ?>
        <div class="input text required">
            <label for="data_vencimento">Vencimento</label>
            <input required="required" name="data_vencimento" id="data_vencimento" type="date">
        </div>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
