<?php
$this->layout = false;
$siteUtils = new \App\Model\Utils\SiteUtils();
$controllerPedido = new \App\Model\Utils\SiteUtilsPedido();
$existstPedidoAberto = false;
if (isset($_SESSION['Auth']['User']['id'])){
    $existstPedidoAberto = $controllerPedido->existsPedidoEmAberto($_SESSION['Auth']['User']['id']);
}
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$empresaUtils = new \App\Model\Utils\EmpresaUtils();
$empresaAberta = $controllerPedido->empresaAberta();
/** @var $tempoEntrega \App\Model\Entity\TemposMedio*/
$tempoEntrega = $tableLocator->get('TemposMedios')->find()->where(['empresa_id' => $empresaUtils->getEmpresaBase(),'tipo'  => \App\Model\Entity\TemposMedio::TIPO_PARA_ENTREGA, 'ativo' => true])->first();
/** @var $tempoColeta \App\Model\Entity\TemposMedio*/
$tempoColeta = $tableLocator->get('TemposMedios')->find()->where(['empresa_id' => $empresaUtils->getEmpresaBase(),'tipo'  => \App\Model\Entity\TemposMedio::TIPO_PARA_COLETA, 'ativo' => true])->first();
/** @var $produtosMaisVendidos \App\Model\Entity\Produto[]*/
$produtosMaisVendidos = $controllerPedido->getProdutosMaisVendidos();
$haveProdutos = count($produtosMaisVendidos);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $siteUtils->ambiguousHeadImportsSite() ?>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php $siteUtils->menuSite() ?>
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
    /** @var $banners \App\Model\Entity\Banner[]*/
    $banners = $tableLocator->get('Banners')->find()->where(['ativo' => true]);
    ?>
    <div style="height: 400px" id="carouselExampleIndicators" class="carousel slide height-size" data-ride="carousel">
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
    <br>
    <br>
    <h2 style="text-align: center">Tempo de Produção</h2>
    <div class="card-deck mb-3 text-center">
        <div class="card mb-6 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Coleta</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title"><?= $tempoColeta->tempo_medio_producao_minutos?> <small class="text-muted"> min</small></h1>
                <span>Não precisa de entrega? busque você mesmo o pedido no restaurante!</span>
            </div>
        </div>
        <div class="card mb-6 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Entrega</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title"><?= $tempoEntrega->tempo_medio_producao_minutos?> <small class="text-muted"> min</small></h1>
                <span>Fique tranquilo, levamos o pedido até sua casa por uma pequena taxa!</span>
            </div>
        </div>
    </div>
    <?php if ($haveProdutos > 0 ){ ?>
        <h2 style="text-align: center">Produtos Mais Vendidos</h2>
        <div class="card-deck mb-3 text-center">
            <?php foreach ($produtosMaisVendidos as $produto){ ?>
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal"><?= $produto->nome_produto ?></h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><small class="text-muted"> R$ </small><?= $produto->preco_produto?></h1>
                    </div>
                    <div style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;" class="card-body">
                        <span><?= $produto->descricao_produto ?></span>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="/pages/produtos?categoria=<?= $produto->categorias_produto_id?>&openProduto=<?= $produto->id?>"><i class="fas fa-search"></i> Visualizar</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php }?>
</div>
<footer style="background-color: #343a40!important; margin-top: 45px;" class="page-footer font-small blue footer">
    <!-- Copyright -->
    <div style="color: white" class="footer-copyright text-center py-3">© 2019 Copyright <a target="_blank" href="https://sites.google.com/view/ladev"> LaDev</a>
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
</body>
</html>
