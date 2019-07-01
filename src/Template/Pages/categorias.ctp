<?php
$siteUtils = new \App\Model\Utils\SiteUtils();
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$this->layout = false;
$controllerPedido = new \App\Model\Utils\SiteUtilsPedido();
$existsPedidoAberto = false;
if (isset($_SESSION['Auth']['User']['id'])){
    $existsPedidoAberto = $controllerPedido->existsPedidoEmAberto($_SESSION['Auth']['User']['id']);
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
    <?php $siteUtils->ambiguousHeadImportsSite() ?>
</head>
<body style="margin-top: 65px;">
<?php $siteUtils->menuSite() ?>
<!-- Page Content -->
<div class="container">
    <?php if(!$empresaAberta){
        $siteUtils->mensagemEmpresaFechada();
        ?>
    <?php $existsPedidoAberto = false;
    }
    ?>
    <?php if($existsPedidoAberto){
        $siteUtils->mensagemPedidoAberto()?>
    <?php }else{?>
    <!-- Page Heading -->
    <h1 class="my-4">Categorias de Produtos
        <small>Todos deliciosos esperando você!</small>
    </h1>
    <div class="row">
    <?php
    foreach ($query as $categoria) {
        $tableLocator = new \Cake\ORM\Locator\TableLocator();
        $midiasTable = $tableLocator->get('Midias');
        $existMidia = $midiasTable->query();
        $existMidia->where(['id'=>$categoria->midia_id]);
        /** @var $existMidia \App\Model\Entity\Midia*/
        $existMidia = $existMidia->first();
        ?>
        <div style="margin-bottom: 10px;" class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
            <div class="card">
                <a href="produtos?categoria=<?= $categoria->id?>&categoriaNome=<?=$categoria->nome_categoria?>">
                    <?php if($existMidia !== null){?>
                        <?php echo $this->Html->image($existMidia->path_midia, array('width' => '100%', 'height' => '22%', 'background-color' => '#343a40')); ?>
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