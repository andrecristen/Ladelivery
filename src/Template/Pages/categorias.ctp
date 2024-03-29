<?php
$siteUtils = new \App\Model\Utils\SiteUtils();
$empresaUtils = new \App\Model\Utils\EmpresaUtils();
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$this->layout = false;
$controllerPedido = new \App\Model\Utils\SiteUtilsPedido();
$existsPedidoAberto = false;
if ($empresaUtils->getUserId()) {
    $existsPedidoAberto = $controllerPedido->existsPedidoEmAberto($empresaUtils->getUserId());
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
    <?php if (!$empresaAberta) {
        $siteUtils->mensagemEmpresaFechada();
        ?>
        <?php $existsPedidoAberto = false;
    }
    ?>
    <?php if ($existsPedidoAberto) {
        $siteUtils->mensagemPedidoAberto() ?>
    <?php } else { ?>
        <!-- Page Heading -->
        <h4 style="text-align: center">Categorias de Produtos
            <small>Todos deliciosos esperando você!</small>
        </h4>
        <br>
        <div class="row">
            <?php
            foreach ($query as $categoria) {
                $tableLocator = new \Cake\ORM\Locator\TableLocator();
                $midiasTable = $tableLocator->get('Midias');
                $existMidia = $midiasTable->query();
                $existMidia->where(['id' => $categoria->midia_id]);
                /** @var $existMidia \App\Model\Entity\Midia */
                $existMidia = $existMidia->first();
                ?>
                <div style="margin-bottom: 10px;" class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                    <div class="card">
                        <a href="produtos?categoria=<?= $categoria->id ?>&categoriaNome=<?= $categoria->nome_categoria ?>">
                            <?php if ($existMidia !== null) { ?>
                                <?php echo $this->Html->image($existMidia->path_midia, ['class' => 'img-fluid']); ?>
                            <?php } else { ?>
                                <?php echo $this->Html->image($empresaUtils::IMAGE_PADRAO_PRODUTOS_SEM_IMAGEM, ['class' => 'img-fluid']); ?>
                            <?php } ?>
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a style="text-decoration-line: none;color: black;" href="produtos?categoria=<?= $categoria->id ?>&categoriaNome=<?= $categoria->nome_categoria ?>"><?= $categoria->nome_categoria ?></a>
                            </h4>
                            <p style="height: 25px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"
                               class="card-text"><?= $categoria->descricao_categoria ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <br>
    <?php } ?>
</div>
</body>