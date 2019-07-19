<?php
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/" class="pull-left btn btn-danger"><i class="fas fa-home"></i> Início</a>
        <a href="/users/profile/<?= $_SESSION['Auth']['User']['id'] ?>" class="pull-left btn btn-success"><i
                    class="fas fa-user-circle"></i> Minha Conta</a>
        <a href="/enderecos/meus-enderecos" class="btn btn-primary"><i class="fas fa-map-marked-alt"></i> Endereços</a>
    </div>
    <br/>
    <br/>
    <?= $this->Form->create($endereco) ?>
    <fieldset>
        <legend>Editar Endereço</legend>
        <?php
        echo $this->Form->control('rua');
        echo $this->Form->control('numero', ['required' => 'required']);
        echo $this->Form->control('bairro');
        echo $this->Form->control('cidade');
        echo $this->Form->control('cep', ['label'=>'CEP']);
        echo $this->Form->control('complemento', ['required'=>'required']);
        echo $this->Form->control('estado', ['options' => \App\Model\Entity\Endereco::getEstados()]);
        ?>
        <br/>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
