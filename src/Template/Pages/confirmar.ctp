<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$cacheControl = '?v=24-01-2019-01';
$this->layout = false;
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$params = ($this->getRequest()->getAttribute('params'));
$pedido = false;
$controllerPedido = new \App\Model\Utils\ValidaPedidoAbertoCliente();
if (isset($_SESSION['Auth']['User']['id'])){
    $pedido = $controllerPedido->existsPedidoEmAberto($_SESSION['Auth']['User']['id']);
}
$pedidoModel = $tableLocator->get('Pedidos')->find()->where(['id' => $pedido,
    'status_pedido'=> \App\Model\Entity\Pedido::STATUS_AGUARDANDO_CONFIRMACAO_CLIENTE,
    'user_id' => $_SESSION['Auth']['User']['id'] ])->first();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pedido : <?= $pedido ?></title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css<?= h($cacheControl) ?>"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css<?= h($cacheControl) ?>"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js<?= h($cacheControl) ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js<?= h($cacheControl) ?>9"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js<?= h($cacheControl) ?>"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/css/bootstrap-select.min.css<?= h($cacheControl) ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/js/bootstrap-select.min.js<?= h($cacheControl) ?>"></script>
    <script src="/js/confirm.js<?= h($cacheControl) ?>"></script>
    <link rel="stylesheet" href="/css/cart2.css<?= h($cacheControl) ?>">

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
                    <a class="nav-link" href="../pages"><i class="fas fa-home"></i> Inicio
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/categorias"><i class="fas fa-th-list"></i> Categorias</a>
                </li>
                <?php if (!isset($_SESSION['Auth']['User']['id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../users/login?typeUser=1"><i class="fas fa-sign-in-alt"></i>
                            Entrar</a>
                    </li>
                <?php } else { ?>
                    <li style="padding-right: 4px;" class="nav-item">
                        <a class="nav-link" href="../users/profile/<?= $_SESSION['Auth']['User']['id'] ?>"><i
                                class="fas fa-user-circle"></i> Minha Conta</a>
                    </li>
                    <li style="padding-right: 4px;" class="nav-item">
                        <a class="nav-link" href="../pages/carrinho?<?= $_SESSION['Auth']['User']['id'] ?>"><i
                                class="fas fa-shopping-cart"></i> Carrinho</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../users/logout"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <main>
        <div class="basket-module">
            <label for="promo-code">Cupom</label>
            <input id="promo-code" type="text" name="promo-code" maxlength="5" class="promo-code-field">
            <button class="promo-code-cta btn-primary">Aplicar</button>
        </div>
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
            $totalEntrega = 0;
            $desconto = 0;
            $itensCarrinho = 0;
            $pedidoProdutos = $tableLocator->get('PedidosProdutos')->find()->where(['pedido_id' => $pedidoModel->id]);
            foreach ($pedidoProdutos as $pedidoProduto) {
                $produtos = $tableLocator->get('Produtos')->find()->where(['id' => intval($pedidoProduto->produto_id)])->limit(1);
                $useProduto = $produtos->first();
                $totalCarrinho = $totalCarrinho + ($pedidoProduto->valor_total_cobrado);
                $itensCarrinho = $itensCarrinho + 1;
                ?>
                <div class="basket-product">
                    <div class="item">
                        <div class="product-details">
                            <h1><strong><span class="item-quantity"></span> <?= $useProduto->nome_produto ?></strong>
                                <br/><?= $useProduto->descricao_produto ?></h1>
                            <?php if ($pedidoProduto->observacao) { ?>
                                <p><strong>Obs.: <?= $pedidoProduto->observacao ?></strong></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="price"><?= $pedidoProduto->valor_total_cobrado / $pedidoProduto->quantidade ?></div>
                    <div class="quantity">
                        <input disabled readonly type="number" value="<?= $pedidoProduto->quantidade ?>" min="1" class="quantity-field">
                    </div>
                    <div class="subtotal"><?= $pedidoProduto->valor_total_cobrado ?></div>
                    <br/>
                    <br/>
                </div>
                <?php
            }
            ?>
        </div>
        <aside>
            <div class="summary">
                <div class="summary-total-items"><span class="total-items"></span>Resumo</div>
                <div class="summary-total">
                    <div class="total-title">Produtos</div>
                    <div class="total-value final-value" id="basket-total"><?= $totalCarrinho ?></div>
                    <div class="total-title">Desconto</div>
                    <div class="total-value final-value" id="basket-total"><?= $desconto ?></div>
                    <div class="total-title">Entrega</div>
                    <div class="total-value final-value" id="basket-total"><?= $totalEntrega ?></div>
                    <br/>
                    <div class="total-title">Total</div>
                    <div class="total-value final-value" id="basket-total"><?= ($totalCarrinho + $totalEntrega) - $desconto ?></div>
                </div>
                <?php if($itensCarrinho > 0) {?>
                    <div class="summary-total">
                        <div style="width: auto; margin-right: 2px;" class="total-title">Forma Pagamento</div>
                        <select class="select-endereco" name="pagamentoSelect">
                            <option disabled selected value="false">Selecione a forma de pagamento</option>
                            <?php
                            /** @var $formasPagamento \App\Model\Entity\FormasPagamento[]*/
                            $formasPagamento = $tableLocator->get('FormasPagamentos')->find();
                            foreach ($formasPagamento as $formaPagamento){
                                ?>
                                <option value="<?= $formaPagamento->id?>" ><?= $formaPagamento->nome?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="summary-checkout">
                        <button onclick="confirmar()" class="checkout-cta btn-success">Confirmar Pedido</button>
                        <br>
                        <button onclick="cancelar()" class="checkout-cta btn-danger">Cancelar Pedido</button>
                    </div>
                <?php }else{?>
                    <div class="alert alert-info" style="text-align: center">
                        Este pedido não possui itens, por favor cancele ele e continue comprando...
                    </div>
                    <div class="summary-checkout">
                        <a href="../pages/categorias" class="checkout-cta btn-warning">Continuar Comprando</a>
                    </div>
                <?php } ?>
            </div>
        </aside>
    </main>
</div>
</body>