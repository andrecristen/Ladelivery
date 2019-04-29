<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Endereco $endereco
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><?= \App\Model\Utils\EmpresaUtils::NOME_EMPRESA_LOJA ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-home')).' Início', array('controller' => 'pages', 'action' => ''), array('escape' => false , 'class' => 'nav-link')) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).' Categorias', array('controller' => 'pages', 'action' => 'categorias'), array('escape' => false , 'class' => 'nav-link')) ?>
                </li>
                <?php if (!isset($_SESSION['Auth']['User']['id'])) { ?>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-in-alt')).' Entrar', array('controller' => 'users', 'action' => 'login'), array('escape' => false , 'class' => 'nav-link')) ?>
                    </li>
                <?php }else{ ?>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-user-circle')).' Minha Conta', array('controller' => 'users', 'action' => 'profile/'.$_SESSION['Auth']['User']['id']), array('escape' => false , 'class' => 'nav-link')) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-shopping-cart')).' Carrinho', array('controller' => 'pages', 'action' => 'carrinho?'.$_SESSION['Auth']['User']['id']), array('escape' => false , 'class' => 'nav-link')) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-out-alt')).' Sair', array('controller' => 'users', 'action' => 'logout'), array('escape' => false , 'class' => 'nav-link')) ?>
                    </li>
                <?php } ?>
        </div>
    </div>
</nav>
<div style="margin-top: 67px;" class="col-sm-12">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/" class="pull-left btn btn-danger"><i class="fas fa-home"></i> Início</a>
        <a href="/users/profile/<?= $_SESSION['Auth']['User']['id'] ?>" class="pull-left btn btn-success"><i
                    class="fas fa-user-circle"></i> Minha Conta</a>
        <a href="/enderecos/meus-enderecos/<?= $_SESSION['Auth']['User']['id'] ?>" class="btn btn-primary"><i class="fas fa-map-marked-alt"></i> Endereços</a>
    </div>
    <br/>
    <br/>
    <?= $this->Form->create($endereco) ?>
    <fieldset>
        <legend><?= __('Adicionar Endereço') ?></legend>
        <?php
        echo $this->Form->control('rua');
        echo $this->Form->control('numero', ['required'=>'required']);
        echo $this->Form->control('bairro');
        echo $this->Form->control('cidade');
        echo $this->Form->control('cep', ['label'=>'CEP']);
        echo $this->Form->control('complemento', ['required'=>'required']);
        echo $this->Form->control('estado', ['options' => $endereco->getEstados()]);
        ?>
        <br/>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>