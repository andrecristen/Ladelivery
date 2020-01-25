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
        <legend><?= __('Adicionar Conta') ?></legend>
        <?php
            echo $this->Form->control('tipo', ['options' => \App\Model\Entity\Conta::getTipoList(), 'empty' => true]);
        ?>
        <br>
        <div class="form-check">
            <input onchange="alternateFieldsCliente(this)" type="checkbox" checked class="form-check-input" id="cliente">&nbsp;
            <label class="form-check-label" for="cliente">Cliente com conta cadastrada</label>
        </div>
        <div id="div_cadastrado">
            <?php
            echo $this->Form->control('user_id', [ 'empty' => true, 'id' => 'cliente_cadastrado', 'label'=> 'Destinatário Cadastrado', 'options' => $users]);
            ?>
        </div>
        <div style="display: none" id="div_nao_cadastrado">
            <?php
            echo $this->Form->control('pessoa', ['empty' => true, 'id' => 'cliente_nao_cadastrado', 'disabled' => 'disabled', 'label'=> 'Destinatário Não Cadastrado']);
            ?>
        </div>
            <?php
            echo $this->Form->control('valor_total', ['class' => 'money']);
            echo $this->Form->control('descricao');
            ?>
            <div class="input text required">
                <label for="data_vencimento">Vencimento</label>
                <input required="required" name="data_vencimento" id="data_vencimento" type="date">
            </div>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
