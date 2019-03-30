<?php
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$cacheControl = new \App\Model\Utils\CacheControl();
$this->layout = false;
$controllerPedido = new \App\Model\Utils\SiteUtilsPedido();
$existstPedidoAberto = false;
if (isset($_SESSION['Auth']['User']['id'])){
    $existstPedidoAberto = $controllerPedido->existsPedidoEmAberto($_SESSION['Auth']['User']['id']);
}
$empresaAberta = $controllerPedido->empresaAberta();
$query = $tableLocator->get('CategoriasProdutos')->find();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Categorias</title>

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

</head>
<body style="margin-top: 65px;">
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

<!-- Page Content -->
<div class="container">
    <?php if(!$empresaAberta){?>
        <div class="row">
            <div style="width: 100%" class="alert alert-danger">
                <h4>Olá, ainda não estamos abertos, ou seja não é possível realizar pedidos novos...<i class="fas fa-sad-cry fa-2x"></i></h4>
            </div>
        </div>
    <?php $existstPedidoAberto = false;
    }
    ?>
    <?php if($existstPedidoAberto){?>
        <div class="row">
            <div style="width: 100%" class="alert alert-info">
                <h4>Você possui pedidos aguardando sua confirmação ou rejeição, certifique-se de concluir primeiro este pedido antes de iniciar um novo!<a href="../pages/confirmar">Para ver o pedido clique aqui</a></h4>
            </div>
        </div>
    <?php }else{?>
    <!-- Page Heading -->
    <h1 class="my-4">Categorias de Produtos
        <small>Todos deliciosos esperando você!</small>
    </h1>
    <div class="row">
    <?php
    foreach ($query as $categoria) {
        $produtosImagensTable = \Cake\ORM\TableRegistry::get('CategoriasProdutosImagens');
        $existImage = $produtosImagensTable->query();
        $existImage->where(['categorias_produto_id'=>$categoria->id]);
        $existImage = $existImage->first();
        ?>
        <div style="margin-bottom: 10px;" class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
            <div class="card">
                <a href="produtos?categoria=<?= $categoria->id?>&categoriaNome=<?=$categoria->nome_categoria?>">
                    <?php if($existImage !== null){?>
                        <?php echo $this->Html->image('categorias/'.$existImage->nome_imagem, array('width' => '100%', 'height' => '22%', 'background-color' => '#343a40')); ?>
                    <?php }else{?>
                        <?php echo $this->Html->image('empresa/padrao.jpeg', array('width' => '100%', 'height' => '22%')); ?>
                    <?php } ?>
                </a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="produtos?categoria=<?= $categoria->id?>&categoriaNome=<?=$categoria->nome_categoria?>"><?= $categoria->nome_categoria?></a>
                    </h4>
                    <p style="height: 25px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" class="card-text"><?= $categoria->descricao_categoria?></p>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
    <br>
    <?php } ?>
</div>
</body>