<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FormasPagamento $formasPagamento
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($formasPagamento) ?>
    <fieldset>
        <legend><?= __('Adicionar Formas Pagamento') ?></legend>
        <?php
            echo $this->Form->control('empresa_id', ['options' => $empresas]);
            echo $this->Form->control('nome');
            echo $this->Form->control('necesista_maquina_cartao');
            echo $this->Form->control('necessita_troco');
        echo $this->Form->control('aumenta_valor', ['label' => 'Porcentagem Juros']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
