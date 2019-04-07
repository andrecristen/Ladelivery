<?php
$cacheControl = new \App\Model\Utils\CacheControl();
$this->layout = false;

$cakeDescription = 'LaDelivery';
$controllerPedido = new \App\Model\Utils\SiteUtilsPedido();
$existstPedidoAberto = false;
if (isset($_SESSION['Auth']['User']['id'])){
    $existstPedidoAberto = $controllerPedido->existsPedidoEmAberto($_SESSION['Auth']['User']['id']);
}

$empresaAberta = $controllerPedido->empresaAberta();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css<?= h($cacheControl->getCacheVersion()) ?>"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css<?= h($cacheControl->getCacheVersion()) ?>"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js<?= h($cacheControl->getCacheVersion()) ?>"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js<?= h($cacheControl->getCacheVersion()) ?>9"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js<?= h($cacheControl->getCacheVersion()) ?>"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <?= $this->Html->css('banner.css') ?>
    <title>LADev - LaDelivery</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
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
<?= $flash->render() ?>
<!-- Page Content -->
<div style="margin-top: 70px;" class="container">
    <?php if(!$empresaAberta){?>
        <div class="row">
            <div style="width: 100%" class="alert alert-danger">
                <h4>Olá, ainda não estamos abertos, ou seja não é possível realizar pedidos novos...<i class="fas fa-sad-cry fa-2x"></i></h4>
            </div>
        </div>
    <?php
        $existstPedidoAberto = false;
    }
    ?>
    <?php if($existstPedidoAberto){?>
        <div class="row">
            <div style="width: 100%" class="alert alert-info">
                <h4>Você possui pedidos aguardando sua confirmação ou rejeição, certifique-se de concluir primeiro este pedido antes de iniciar um novo!<a href="pages/confirmar">Para ver o pedido clique aqui</a></h4>
            </div>
        </div>
    <?php }
    $tableLocator = new \Cake\ORM\Locator\TableLocator();
    /** @var $banners \App\Model\Entity\Banner[]*/
    $banners = $tableLocator->get('Banners')->find()->where(['ativo' => true]);
    ?>
    <div id="carouselExampleIndicators" class="carousel slide height-size" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $count = 0;
            foreach ($banners as $banner){
                if($count == 0){
                    echo  '<li data-target="#carouselExampleIndicators" data-slide-to="'.$count.'" class="active"></li>';
                }else{
                    echo  '<li data-target="#carouselExampleIndicators" data-slide-to="'.$count.'"></li>';
                }
                $count++;
            }?>
        </ol>
        <div class="carousel-inner">
            <?php
            $count = 0;
            foreach ($banners as $banner){
                /** @var $midia \App\Model\Entity\Midia*/
                $midia = $tableLocator->get('Midias')->find()->where(['id' => $banner->midia_id])->first();
                if($count == 0){
                    echo '<div class="carousel-item height-size active">';
                }else{
                    echo '<div class="carousel-item height-size">';
                }
                echo '<img class="height-size" src="img/'.$midia->path_midia.'" alt="'.$banner->nome_banner.'">';
                $count++;
                echo '</div>';
            }?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Page Heading -->
    <h1 class="my-4">Bem Vindo ao LaDelivery!
        <br>
        <small>Só aqui você encontra as melhores comidas, afinal de contas, comida une as pessoas!</small>
        <small>E degustar um comida saborosa, prática e rápida é com a gente mesmo, então ta esperando o que?</small>
        <br>
        <small>Vai logo dar um conferida nas nossas categorias de lanches saborosos, aposto que algum vai agradar seu paladar...</small>
    </h1>
</div>
<!-- Footer -->
<footer style="background-color: #343a40!important; margin-top: 45px;" class="page-footer font-small blue footer">
    <!-- Copyright -->
    <div style="color: white" class="footer-copyright text-center py-3">© 2019 Copyright <a href=""> LaDev</a>
    </div>
    <div class="footer-copyright text-center py-3">
        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-user-shield')).' Painel Administrador', array('controller' => 'Financeiro', 'action' => 'painel'), array('escape' => false , 'class' => 'btn btn-sm btn-info')) ?>
    </div>
</footer>
<style>
    html, body {
        height: 100%;
    }
    body {
        display: flex;
        flex-direction: column;
    }
    .footer {
        flex-shrink: 0;
    }
</style>
<!-- Footer -->
</body>
</html>
