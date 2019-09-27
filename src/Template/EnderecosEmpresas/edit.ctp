<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnderecosEmpresa $enderecosEmpresa
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($enderecosEmpresa) ?>
    <fieldset>
        <legend><?= __('Editar Endereço Empresa') ?></legend>
        <?php
        echo $this->Form->control('empresa_id', ['options' => $empresas, 'disabled' => 'disabled', 'required' => 'required']);
        echo $this->Form->control('rua');
        echo $this->Form->control('numero');
        echo $this->Form->control('bairro');
        echo $this->Form->control('cidade');
        echo $this->Form->control('estado' , ['options' => \App\Model\Entity\Endereco::getEstados()]);
        echo $this->Form->control('cep', ['class' => 'cep']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
