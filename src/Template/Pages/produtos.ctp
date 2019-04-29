<?php
$cacheControl = new \App\Model\Utils\CacheControl();
$this->layout = false;
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$query = $tableLocator->get('Produtos')->find();
$params = ($this->getRequest()->getAttribute('params'));
$controllerPedido = new \App\Model\Utils\SiteUtilsPedido();
$existstPedidoAberto = false;
if (isset($_SESSION['Auth']['User']['id'])){
    $existstPedidoAberto = $controllerPedido->existsPedidoEmAberto($_SESSION['Auth']['User']['id']);
}
$empresaAberta = $controllerPedido->empresaAberta();
if(!$existstPedidoAberto || !$empresaAberta){
    $categoria = $params['?']['categoria'];
    $categoriaNome = $params['?']['categoriaNome'];
    $query->where(['categorias_produto_id' => intval($categoria), 'ativo_produto' => true]);
}else{
    $query = [];
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Produtos : <?= $categoriaNome ?></title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css<?= h($cacheControl->getCacheVersion()) ?>"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css<?= h($cacheControl->getCacheVersion()) ?>"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js<?= h($cacheControl->getCacheVersion()) ?>9"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js<?= h($cacheControl->getCacheVersion()) ?>"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/css/bootstrap-select.min.css<?= h($cacheControl->getCacheVersion()) ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/js/bootstrap-select.min.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
    <script src="/ladev/alert/alertify.min.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
    <link rel="stylesheet" href="/ladev/alert/css/alertify.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
    <link rel="stylesheet" href="/ladev/alert/css/themes/bootstrap.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
    <?php echo $this->Html->script('produto.js'); ?>
    <?php echo $this->Html->script('tabs.js'); ?>
    <?php echo $this->Html->css('tabs.css'); ?>
    <?php echo $this->Html->css('bloq.css'); ?>
</head>
<body style="margin-top: 65px;">
<div class="div-ajax-carregamento-pagina"><h1>Carregando...</h1></div>


<div class="container">
    <?php if(!$empresaAberta){?><nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
    <!-- Button trigger modal -->
    <button id="openModal" style="display: none" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false">
        abrir modal
    </button>

    <!-- Modal -->
    <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div style="min-height: 70%" class="modal-content">
                <div class="modal-header">
                    <?php
                    if(isset($_SESSION['Auth']['User']['id']) && $empresaAberta){?>
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar ao carrinho</h5>
                    <?php } ?>
                    <?php
                    if(!isset($_SESSION['Auth']['User']['id']) || !$empresaAberta){?>
                        <h5 class="modal-title" id="exampleModalLabel">Visualizar Produto</h5>
                    <?php } ?>


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab">
                        <button id="initialTabModal" class="tablinks" onclick="openTab(event, 'geral')">Geral</button>
                        <button class="tablinks" onclick="openTab(event, 'opcoes')">Opções</button>
                    </div>

                    <div id="geral" class="tabcontent">
                        <div class="form-horizontal">
                            <div style="display: none" class="form-group">
                                <label for="exampleFormControlInput1">#Produto</label>
                                <input type="text" readonly class="form-control" id="idProduto">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Produto</label>
                                <input type="text" readonly class="form-control" id="nomeProduto">
                            </div>
                            <div style="display: none" class="form-group">
                                <label for="exampleFormControlInput1">Preço Produto Original</label>
                                <input type="text" readonly class="form-control" id="precoProdutoOriginal">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Preço</label>
                                <input type="text" readonly class="form-control" id="precoProduto">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descrição</label>
                                <textarea class="form-control" readonly id="descricaoProduto" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Quantidade</label>
                                <input class="form-control" type="number" onkeyup="verificaQuantidadeIsInt(event)" id="quantidadeProduto" min="1" max="100" step="1" value="1">
                            </div>
                            <?php if(isset($_SESSION['Auth']['User']['id']) && $empresaAberta){?>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Observação</label>
                                    <textarea placeholder="Digite observações, por exemplo, retirar pepino."
                                              class="form-control" id="observacaoDigitada" rows="2"></textarea>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div id="opcoes" style="min-height:60%" class="tabcontent">
                        <div id="contentOptions">
                        <!--      SERVE PARA PODER APENDAR A LISTAS CRIADAS DOS PRODUTOS        -->
                        </div>
                    </div>
                </div>

                <?php
                if(isset($_SESSION['Auth']['User']['id']) && $empresaAberta){?>
                    <div class="modal-footer">
                        <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" onclick="addItemToCart(<?= $_SESSION['Auth']['User']['id'] ?>)" class="btn btn-primary">Confirmar</button>
                    </div>
               <?php } ?>
            </div>
        </div>
    </div>
    <h4 class="my-4">Produtos da Categoria: <?= strtoupper($categoriaNome) ?></h4>
    <?php if (!isset($_SESSION['Auth']['User']['id'])) { ?>
        <div class="row">
            <div style="width: 100%" class="alert alert-info">
                <h4><i class="fas fa-exclamation-triangle fa-fw" style="color: #ff1b2e"></i>Para poder adicionar ao carrinho, por favor entre com sua conta!</h4>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <?php
        $produtoscount = 0;
        foreach ($query as $produto) {
//            Buscamos a imagem do produto
            $midiaTable = $tableLocator->get('Midias');
            $existMidia = $midiaTable->find();
            $existMidia->where(['id' => $produto->midia_id]);
            /** @var $existMidia \App\Model\Entity\Midia*/
            $existMidia = $existMidia->first();
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                <div class="card" style="margin-bottom: 5px">
                    <a onclick="openModalAddCart(<?= $produto->id ?>, <?= $_SESSION['Auth']['User']['id'] ?>)">
                        <?php if ($existMidia !== null) { ?>
                            <?php echo $this->Html->image($existMidia->path_midia, array('width' => '100%', 'height' => '22%', 'background-color' => '#343a40')); ?>
                        <?php } else { ?>
                            <?php echo $this->Html->image('empresa/padrao.jpeg', array('width' => '100%', 'height' => '22%')); ?>
                        <?php } ?>
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <span><?= $produto->nome_produto ?></span>
                            <br/>
                            <span><?= 'R$ ' . $produto->preco_produto ?></span>
                        </h4>
                        <p style="height: 120px; overflow-y: auto; overflow-x: hidden;"
                           class="card-text"><?= $produto->descricao_produto ?></p>
                    </div>
                    <div class="card-footer">
                        <?php if (isset($_SESSION['Auth']['User']['id']) && $empresaAberta) { ?>
                            <button class="btn btn-success" style="width: 100%"
                                    onclick="openModalAddCart(<?= $produto->id ?>, <?= $_SESSION['Auth']['User']['id'] ?>)">
                                Adicionar ao carrinho <i style="display: none" id="loading-<?= $produto->id?>" class="fa fa-spinner fa-spin"></i>
                            </button>
                        <?php } else { ?>
                            <button disabled class="btn btn-success" style="width: 100%">Adicionar ao carrinho </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
            $produtoscount++;
        }
        if ($produtoscount < 1) { ?>
            <div style="width: 100%" class="alert alert-danger" role="alert">
                <i class="far fa-grin-beam-sweat fa-3x" style="color: #000000"></i>&nbsp;<span>Está categoria ainda não possui nenhum item cadastrado, mas não deixe de visitar para encontrar novidades!</span>
            </div>
        <?php } ?>
    </div>
    <br>
    <?php }?>
</div>
</body>