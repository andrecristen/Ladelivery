<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
//var_dump($produtosAvaliacoes);
$siteUtils = new \App\Model\Utils\SiteUtils();
$notaProduto = $siteUtils->getValueStarsProduto($produto->id);
$cacheControl = new \App\Model\Utils\CacheControl();
?>
<script src="/js/web-app/directives/ui-input-star.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
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
<div class="card-deck mb-3 text-center">
    <div class="card mb-6 box-shadow">
        <div class="card-header">
            <h5 class="my-0 font-weight-normal">Nota média dos clientes</h5>
        </div>
        <div class="card-body">
            <div class="rating-block">
                <h2 class="bold padding-bottom-7"><?= $notaProduto ?> <small>/ 5</small></h2>
                <?php $siteUtils->showStarsByNota($notaProduto)?>
                <br>
                <span style="color: #666; font-size: .75em; line-height: 7px;">Com base em <?= $avaliacoes ?> avaliações</span>
            </div>
        </div>
    </div>
    <div class="card mb-6 box-shadow">
        <div class="card-header">
            <h5 class="my-0 font-weight-normal">Produto</h5>
        </div>
        <div class="card-body">
            <div class="rating-block">
                <h2 class="bold padding-bottom-7"><?= $produto->nome_produto?></h2>
                <span class="padding-bottom-7"><small>Preço R$ </small><?= $produto->preco_produto?></span>
            </div>
        </div>
    </div>
</div>


<div class="col-sm-12">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-4">

            </div>
        </div>
    </div>
    <br>
    <fieldset>
        <legend>Avaliações de clientes</legend>
        <br>
    <?php foreach ($produtosAvaliacoes as $avaliacao){
        $tableLocator = new \Cake\ORM\Locator\TableLocator();
        $usuario = $tableLocator->get('Users')->find()->where(['id' => $avaliacao->user_id])->first()?>
        <div class="row">
            <div class="col-sm-2">
                <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                <div class="review-block-name"><?= $usuario->nome_completo ?> </div>
            </div>
            <div class="col-sm-10">
                <div class="review-block-rate">
                    <?php $siteUtils->showStarsByNota($avaliacao->nota)?>
                </div>
                <div class="review-block-description">
                    <?= $avaliacao->comentario?>
                </div>
            </div>
        </div>
        <fieldset>
            <legend></legend>
        </fieldset>
    <?php } ?>
    <?php if($showForm){
    echo $this->Form->create($produtoAvaliacao, ['action' => 'addAvaliacao/'. $produtoId]);
    ?>
    </fieldset>
    <fieldset>
        <legend>Avalie você também</legend>
        <?php
        echo $this->Form->control('nota', ['style' => 'display: none', 'value' => 0]);
        ?>
        <div ng-app="web-app">
            <ui-input-star></ui-input-star>
        </div>
        <?php
        echo $this->Form->control('comentario', ['type' => 'textarea']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar Avaliação')) ?>
    <?= $this->Form->end() ?>
    <?php }?>
</div>
<br>
<style>
    body {
        padding-top: 70px;
    }
    .rating-block{
        border:1px solid #EFEFEF;
        padding:15px 15px 20px 15px;
        border-radius:3px;
    }
    .bold{
        font-weight:700;
    }
    .padding-bottom-7{
        padding-bottom:7px;
    }

    .review-block-name{
        font-size:12px;
        margin:10px 0;
    }
    .review-block-description{
        font-size:13px;
    }
</style>

