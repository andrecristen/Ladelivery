<?php
$siteUtils = new \App\Model\Utils\SiteUtils();
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
    <?php $siteUtils->ambiguousHeadImportsSite() ?>
    <script src="/js/cart.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
    <link rel="stylesheet" href="/css/cart.css<?= h($cacheControl->getCacheVersion()) ?>">
    <script src="/ladev/alert/alertify.min.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
    <link rel="stylesheet" href="/ladev/alert/css/alertify.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
    <link rel="stylesheet" href="/ladev/alert/css/themes/bootstrap.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
</head>
<body style="margin-top: 65px;">
<?php $siteUtils->menuSite() ?>
<div class="container main-cart">
    <main>
        <?php if(!$empresaAberta){
            $siteUtils->mensagemEmpresaFechada()?>
        <?php
            return;
        }
        ?>
        <?php if($existstPedidoAberto){
            $siteUtils->mensagemPedidoAberto()?>
        <?php }else{?>
            <h4>Carrinho <button title="Ir para o final da página" style="float: right" class="btn btn-sm btn-primary" onclick="scrollToConfirm()"><i class="fas fa-fast-forward"></i> Fim Da Página</button></h4>
            <div class="basket">
                <div class="basket-labels">
                    <ul>
                        <li class="item item-heading">Produto</li>
                        <li class="price">Preço R$</li>
                        <li class="quantity">Quantidade</li>
                        <li class="subtotal">Total R$</li>
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
                                <h1>
                                    <strong>
                                        <span class="show-mobile">Produto: </span>
                                        <span class="item-quantity"></span>
                                        <?= $useProduto->nome_produto ?>
                                    </strong>
                                    <br/>
                                    <span class="show-mobile">Descrição: </span>
                                    <?= $useProduto->descricao_produto ?>
                                </h1>
                                <?php if ($carrinhoProduto->observacao) { ?>
                                    <p><strong>Obs.: <?= $carrinhoProduto->observacao ?></strong></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="price">
                            <span class="show-mobile">Preço R$: </span>
                            <?= $carrinhoProduto->valor_total_cobrado / $carrinhoProduto->quantidades ?>
                        </div>
                        <div class="quantity">
                            <span class="show-mobile">Quantidade: </span>
                            <?= $carrinhoProduto->quantidades ?>
                        </div>
                        <div class="subtotal">
                            <span class="show-mobile">Total R$: </span>
                            <?= $carrinhoProduto->valor_total_cobrado ?>
                        </div>
                        <br/>
                        <br/>
                        <div class="remove">
                            <button class="btn btn-sm btn-danger" onclick="removeItemCarrinho(<?= $carrinhoProduto->id ?>)">Remover <i class="fas fa-trash"></i></button>
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
                    </div>
                    <?php if($itensCarrinho > 0) {?>
                        <div class="summary-total">
                            <div style="width: auto; margin-right: 2px;" class="total-title">Endereço</div>
                            <a style="font-size: 15px" href="../enderecos/add-endereco-cliente"><i class="far fa-plus-square"></i> Novo</a>
                            <select class="select-endereco" name="enderecoSelect">
                                <?php
                                $enderecos = $tableLocator->get('Enderecos')->find()->where(['user_id' => intval($_SESSION['Auth']['User']['id'])]);
                                foreach ($enderecos as $endereco){
                                    ?>
                                    <option value="<?= $endereco->id?>">Rua <?= $endereco->rua?> Número <?= $endereco->numero?> Bairro <?= $endereco->bairro?>, <?= $endereco->cidade?>-<?= $endereco->estado?> </option>
                                    <?php
                                }
                                ?>
                                <option value="<?= \App\Model\Entity\Pedido::RETIRAR_NO_LOCAL?>">NÃO PRECISO DE ENTREGA, IREI BUSCAR O PEDIDO</option>
                            </select>
                        </div>
                        <div class="summary-checkout">
                            <button id="btnFecharCarrinho" onclick="fecharCarrinho()" class="checkout-cta btn-success">Confirmar Conteúdo</button>
                            <br>
                            <a style="margin-top: 25px;" href="../pages/categorias" class="checkout-cta btn-warning">Continuar Comprando</a>
                        </div>
                        <div style="padding: 10px; text-align: center" class="summary-checkout">
                            <span>Atenção! Ao clicar em confirmar conteúdo você será redirecionado para a tela final de confirmação do pedido, que conterá o preço final do pedido e o custo de entrega para o endereço selecionado, assim como a seleção da forma de pagamento.</span>
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
