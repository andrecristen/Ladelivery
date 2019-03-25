<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($empresa) ?>
    <fieldset>
        <legend><?= __('Editar Empresa') ?></legend>
        <?php
        echo $this->Form->control('nome_fantasia');
        echo $this->Form->control('cnpj');
        echo $this->Form->control('ie');
        echo $this->Form->control('ativa');
        ?>
        <br/>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
