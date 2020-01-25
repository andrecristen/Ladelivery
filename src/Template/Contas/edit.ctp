<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conta $conta
 */
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
?>
<div class="col-sm-12">
    <?= $this->Html->script('pedido.js' . $cacheVersion); ?>
    <div class="alert alert-info">
        <span>Caso o destinatário for cadastrado, utilize o campo "Destinatário Cadastrado", caso contrário utilize o campo "Destinatário Não Cadastrado"!</span>
    </div>
    <?= $this->Form->create($conta) ?>
    <fieldset>
        <legend><?= __('Editar Conta') ?></legend>
        <?php
            echo $this->Form->control('tipo', ['options' => \App\Model\Entity\Conta::getTipoList()]);
        ?>
        <br>
        <div class="form-check">
            <input onchange="alternateFieldsCliente(this)" type="checkbox" <?= $checked ?> class="form-check-input" id="cliente">&nbsp;
            <label class="form-check-label" for="cliente">Cliente com conta cadastrada</label>
        </div>
        <div <?= $styleCadastrado ?> id="div_cadastrado">
            <?php
            echo $this->Form->control('user_id', ['id' => 'cliente_cadastrado', 'label'=> 'Destinatário Cadastrado', 'options' => $users]);
            ?>
        </div>
        <div <?= $styleNaoCadastrado ?> id="div_nao_cadastrado">
            <?php
            echo $this->Form->control('pessoa', ['id' => 'cliente_nao_cadastrado', 'disabled' => 'disabled', 'label'=> 'Destinatário Não Cadastrado']);
            ?>
        </div>
        <?php
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
