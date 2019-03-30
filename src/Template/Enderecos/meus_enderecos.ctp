<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">LaDelivery</a>
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
        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-plus')).' Adicionar Novo', array('controller' => 'enderecos', 'action' => 'addEnderecoCliente'), array('escape' => false , 'class' => 'btn btn-primary')) ?>
    </div>
    <br/>
    <br/>
    <div class="alert alert-primary" role="alert">
        Atenção! Edite um endereço de cada vez e salve antes de editar o próximo.
    </div>
    <?php
    $enderecoModel = new \App\Model\Entity\Endereco();
    $enderecosCount = 0;
    foreach ($enderecos as $endereco) {
        $enderecosCount = $enderecosCount + 1;
        ?>
        <?= $this->Form->create($endereco, ['action' => '/meus-enderecos/']) ?>
        <fieldset>
            <legend><?= 'Endereço #' . $endereco->id ?> - <a style="margin-bottom: 2px;" href="/enderecos/excluir-endereco-cliente/<?= $endereco->id ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a></legend>
            <?php
            echo $this->Form->control('rua');
            echo $this->Form->control('numero', ['required' => 'required']);
            echo $this->Form->control('bairro');
            echo $this->Form->control('cidade');
            echo $this->Form->control('cep', ['label'=>'CEP']);
            echo $this->Form->control('complemento', ['required'=>'required']);
            echo $this->Form->control('estado', ['options' => $enderecoModel->getEstados()]);
            ?>
            <br/>
        </fieldset>
        <?= $this->Form->button(__('Salvar')) ?>
        <?= $this->Form->end() ?>
        <br/>
    <?php }
    if ($enderecosCount == 0) {
        echo '<h1>Você ainda não possui endereços cadastrados</h1>';
    }
    ?>
</div>