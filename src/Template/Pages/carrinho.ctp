<?php
$cacheControl = new \App\Model\Utils\CacheControl();
$this->layout = false;
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$controllerPedido = new \App\Model\Utils\SiteUtilsPedido();
$existstPedidoAberto = false;
if (isset($_SESSION['Auth']['User']['id'])){
    $existstPedidoAberto = $controllerPedido->existsPedidoEmAberto($_SESSION['Auth']['User']['id']);
}if(!$existstPedidoAberto){
    $query = $tableLocator->get('ItensCarrinhos')->find()->where(['user_id' => intval($_SESSION['Auth']['User']['id'])]);
}
$empresaAberta = $controllerPedido->empresaAberta();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Carrinho</title>
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
    <script src="/js/cart.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
    <link rel="stylesheet" href="/css/cart.css<?= h($cacheControl->getCacheVersion()) ?>">
    <script src="/ladev/alert/alertify.min.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
    <link rel="stylesheet" href="/ladev/alert/css/alertify.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
    <link rel="stylesheet" href="/ladev/alert/css/themes/bootstrap.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
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
<div class="container main-cart">
    <main>
        <?php if(!$empresaAberta){?>
            <div class="row">
                <div style="width: 100%" class="alert alert-danger">
                    <h4>Olá, ainda não estamos abertos, ou seja não é possível realizar pedidos...<i class="fas fa-sad-cry fa-2x"></i></h4>
                </div>
            </div>
        <?php
            return;
        }
        ?>
        <?php if($existstPedidoAberto){?>
            <div class="row">
                <div style="width: 100%" class="alert alert-info">
                    <h4>Você possui pedidos aguardando sua confirmação ou rejeição, certifique-se de concluir primeiro este pedido antes de iniciar um novo!<a href="../pages/confirmar">Para ver o pedido clique aqui</a></h4>
                </div>
            </div>
        <?php }else{?>
            <h4>Carrinho</h4>
            <div class="basket">
                <div class="basket-labels">
                    <ul>
                        <li class="item item-heading">Produto</li>
                        <li class="price">Preço</li>
                        <li class="quantity">Quantidade</li>
                        <li class="subtotal">Total</li>
                    </ul>
                </div>
                <?php
                $totalCarrinho = 0;
                $itensCarrinho = 0;
                foreach ($query as $carrinhoProduto) {
                    $produtos = $tableLocator->get('Produtos')->find()->where(['id' => intval($carrinhoProduto->produto_id)])->limit(1);
                    $useProduto = $produtos->first();
                    $totalCarrinho = $totalCarrinho + ($carrinhoProduto->valor_total_cobrado);
                    $itensCarrinho = $itensCarrinho + 1;
                    ?>
                    <div class="basket-product">
                        <div class="item">
                            <div class="product-details">
                                <h1><strong><span class="item-quantity"></span> <?= $useProduto->nome_produto ?></strong>
                                    <br/><?= $useProduto->descricao_produto ?></h1>
                                <?php if ($carrinhoProduto->observacao) { ?>
                                    <p><strong>Obs.: <?= $carrinhoProduto->observacao ?></strong></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="price"><?= $carrinhoProduto->valor_total_cobrado / $carrinhoProduto->quantidades ?></div>
                        <div class="quantity">
                            <input disabled type="number" value="<?= $carrinhoProduto->quantidades ?>" min="1" class="quantity-field">
                        </div>
                        <div class="subtotal"><?= $carrinhoProduto->valor_total_cobrado ?></div>
                        <br/>
                        <br/>
                        <div class="remove">
                            <button class="btn btn-sm btn-danger" onclick="removeItemCarrinho(<?= $carrinhoProduto->id ?>)">Remover</button>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <aside>
                <div class="summary">
                    <div class="summary-total-items"><span class="total-items"></span>Resumo</div>
                    <div class="summary-total">
                        <div class="total-title">Total</div>
                        <div class="total-value final-value" id="basket-total"><?= $totalCarrinho ?></div>
                        <div class="total-title hide">Desconto</div>
                        <div class="total-value final-value hide" id="basket-total">10</div>
                        <div class="total-title hide">Final</div>
                        <div class="total-value final-value hide" id="basket-total">718</div>
                    </div>
                    <?php if($itensCarrinho > 0) {?>
                        <div class="summary-total">
                            <div style="width: auto; margin-right: 2px;" class="total-title">Endereço</div><a href="../enderecos/add-endereco-cliente" class=""><i class="far fa-plus-square"></i>Novo</a>
                            <select class="select-endereco" name="enderecoSelect">
                                <?php
                                $enderecos = $tableLocator->get('Enderecos')->find()->where(['user_id' => intval($_SESSION['Auth']['User']['id'])]);
                                foreach ($enderecos as $endereco){
                                    ?>
                                    <option value="<?= $endereco->id?>">Rua <?= $endereco->rua?> Número <?= $endereco->numero?> Bairro <?= $endereco->bairro?>, <?= $endereco->cidade?>-<?= $endereco->estado?> </option>
                                    <?php
                                }
                                ?>
                                <option value="retirar-no-local">NÃO PRECISO DE ENTREGA, IREI BUSCAR O PEDIDO</option>
                            </select>
                        </div>
                        <div class="summary-checkout">
                            <button onclick="fecharCarrinho()" class="checkout-cta btn-success">Confirmar Conteúdo</button>
                            <br>
                            <a href="../pages/categorias" class="checkout-cta btn-warning">Continuar Comprando</a>
                        </div>
                        <div class="summary-checkout">
                            <span>Atenção! Ao clicar em confirmar conteúdo você será redirecionado para a tela final de cofirmação do pedido, que conterá o preço final do pedido e o custo de entrega para o endereço selecionado.</span>
                        </div>
                    <?php }else{?>
                        <div class="alert alert-info" style="text-align: center">
                            Você não possui nenhum item no seu carrinho
                        </div>
                        <div class="summary-checkout">
                            <a href="../pages/categorias" class="checkout-cta btn-warning">Continuar Comprando</a>
                        </div>
                    <?php } ?>
                </div>
            </aside>
        <?php }?>
    </main>
</div>
</body>
