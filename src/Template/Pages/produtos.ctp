<?php
$cacheControl = new \App\Model\Utils\CacheControl();
$this->layout = false;
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$params = ($this->getRequest()->getAttribute('params'));
$controllerPedido = new \App\Model\Utils\SiteUtilsPedido();
$siteUtils = new \App\Model\Utils\SiteUtils();
$empresaUtils = new \App\Model\Utils\EmpresaUtils();
$existstPedidoAberto = false;
if ($empresaUtils->getUserId()){
    $existstPedidoAberto = $controllerPedido->existsPedidoEmAberto($_SESSION['Auth']['User']['id']);
}
$empresaAberta = $controllerPedido->empresaAberta();
if(!$existstPedidoAberto || !$empresaAberta){
    $categoria = $params['?']['categoria'];
    $categoriaNome = $params['?']['categoriaNome'];
    if(!$categoriaNome){
        /** @var $categoriaModel \App\Model\Entity\CategoriasProduto*/
        $categoriaModel = $tableLocator->get('CategoriasProdutos')->find()->where(['id' => $categoria])->first();
        $categoriaNome = $categoriaModel->nome_categoria;
    }
}
$produtoOpen = $params['?']['openProduto'];
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Produtos : <?= $categoriaNome ?></title>
    <?php $siteUtils->ambiguousHeadImportsSite() ?>
    <script src="/ladev/alert/alertify.min.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
    <link rel="stylesheet" href="/ladev/alert/css/alertify.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
    <link rel="stylesheet" href="/ladev/alert/css/themes/bootstrap.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
    <?php echo $this->Html->script('produto.js'); ?>
    <?php echo $this->Html->script('tabs.js'); ?>
    <?php echo $this->Html->css('tabs.css'); ?>
    <?php echo $this->Html->css('bloq.css'); ?>
</head>
<body style="margin-top: 65px;">
<div class="div-ajax-carregamento-pagina">
    <div id="text">Carregando Informações<br/><i class="fas fa-spinner fa-spin"></i></div>
</div>
<?php $siteUtils->menuSite() ?>
<div class="container">
    <?php if(!$empresaAberta){
        $siteUtils->mensagemEmpresaFechada()?>
    <?php $existstPedidoAberto = false;
    }
    ?>
    <?php if($existstPedidoAberto){
        $siteUtils->mensagemPedidoAberto()?>
    <?php }else{
        $siteUtils->createFormAdicionarProduto();
    ?>
    <?php if (!$empresaUtils->getUserId()) {
        $siteUtils->mensagemLogarParaComprar()?>
    <?php } ?>
    <h4 style="text-align: center">Produtos da Categoria: <?= strtoupper($categoriaNome) ?></h4>
    <br>
    <div class="row">
        <?php
            $siteUtils->createProdutosCategoria($categoria);
        }?>
    </div>
    <?php if($produtoOpen){ ?>
    <script>
        $(document).ready(function () {
            openModalAddCart(<?= $produtoOpen ?>);
        });
    </script>
    <?php } ?>
    <style>
        .checked-star {
            color: orange;
        }
        li .selected{
            background: #7fffd459 !important;
        }
    </style>
</body>