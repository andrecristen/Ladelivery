<?php
$siteUtils = new \App\Model\Utils\SiteUtils();
$cacheControl = new \App\Model\Utils\CacheControl();
$this->layout = false;
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$query = $tableLocator->get('Produtos')->find();
$params = ($this->getRequest()->getAttribute('params'));
$controllerPedido = new \App\Model\Utils\SiteUtilsPedido();
$siteUtils = new \App\Model\Utils\SiteUtils();
$existstPedidoAberto = false;
if (isset($_SESSION['Auth']['User']['id'])){
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
    $query->where(['categorias_produto_id' => intval($categoria), 'ativo_produto' => true]);
}else{
    $query = [];
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
<div class="div-ajax-carregamento-pagina"><h1>Carregando...</h1></div>
<?php $siteUtils->menuSite() ?>
<div class="container">
    <?php if(!$empresaAberta){
        $siteUtils->mensagemEmpresaFechada()?>
    <?php $existstPedidoAberto = false;
    }
    ?>
    <?php if($existstPedidoAberto){
        $siteUtils->mensagemPedidoAberto()?>
    <?php }else{?>
    <!-- Button modal -->
    <button id="openModal" style="display: none" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false">
        abrir modal
    </button>
    <!-- Modal -->
    <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div style="min-height: 95%" class="modal-content">
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
                    <div id="opcoes" class="tabcontent">
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
    <?php if (!isset($_SESSION['Auth']['User']['id'])) {
        $siteUtils->mensagemLogarParaComprar()?>
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
            <div style="cursor: pointer!important;" class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                <div class="card" style="margin-bottom: 5px">
                    <a onclick="openModalAddCart(<?= $produto->id ?>)">
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
                            <button title="Adicionar ao carrinho" class="btn btn-sm btn-success" style="width: 45%"
                                    onclick="openModalAddCart(<?= $produto->id ?>)">
                                <i class="fas fa-cart-plus"></i> Comprar <i style="display: none" id="loading-<?= $produto->id?>" class="fa fa-spinner fa-spin"></i>
                            </button>
                        <?php } else { ?>
                            <button title="Adicionar ao carrinho" disabled class="btn btn-sm btn-success" style="width: 45%"><i class="fas fa-cart-plus"></i> Comprar <i style="display: none" id="loading-<?= $produto->id?>" class="fa fa-spinner fa-spin"></i>
                            </button>
                        <?php } ?>
                        <a style="text-decoration-line: none;color: black;" title="Avaliar Produto" href="../ProdutosAvaliacoes/listAvaliacoes/<?= $produto->id?>">
                            <i class="far fa-clipboard"></i>
                            <?php $siteUtils->getStarsProduto($produto->id)?>
                        </a>
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
<style>
    .checked-star {
        color: orange;
    }
    li .selected{
        background: #7fffd459 !important;
    }
</style>
<?php if($produtoOpen){ ?>
<script>
    $(document).ready(function () {
        openModalAddCart(<?= $produtoOpen ?>);
    });
</script>
<?php } ?>
</body>