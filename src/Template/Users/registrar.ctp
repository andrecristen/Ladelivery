<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
//$this->setLayout(null);
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
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Registrar-se') ?></legend>
        <?php
        echo $this->Form->control('nome_completo');
        echo $this->Form->control('apelido');
        ?>
    </fieldset>
    <fieldset>
        <legend>Dados login</legend>
        <?php
        echo $this->Form->control('login',['type'=>'email']);
        echo $this->Form->control('password', ['label'=>'Senha']);
        echo $this->Form->control('confirm_password', ['label'=>'Confirmar Senha', 'type'=>'password', 'required'=>'required']);
        ?>
    </fieldset>
    <fieldset>
        <legend>Nascimento</legend>
        <?php
        echo $this->Form->control('dia_nascimento', ['label'=>'Dia']);
        echo $this->Form->control('mes_nascimento', ['label'=>'Mês']);
        echo $this->Form->control('ano_nascimento', ['label'=>'Ano']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Registrar')) ?>
    <?= $this->Form->end() ?>
</div>
