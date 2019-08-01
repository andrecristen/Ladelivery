<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
echo $this->Html->script('pedidos.js' . $cacheVersion);
?>
<style>
    .col-sm-4{
        margin-bottom: 15px;
    }
    .btn-warning{
        color: #ffffff;
    }
    .btn-warning:hover{
        color: #ffffff;
    }
</style>
<script src="/ladev/alert/alertify.min.js<?= h($cacheVersion) ?>"></script>
<link rel="stylesheet" href="/ladev/alert/css/alertify.min.css<?= h($cacheVersion) ?>" />
<link rel="stylesheet" href="/ladev/alert/css/themes/bootstrap.min.css<?= h($cacheVersion) ?>" />
<div class="col-sm-12">
    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-list')) . ' Visualização em Lista', array('action' => 'index'), array('escape' => false, 'class' => 'btn btn-info btn-sm', 'title' => 'Visualização Clássica'))?>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-success">
                    <h5 class="card-title"><i class="fas fa-gift"></i> Novos</h5>
                    <p class="card-text">Atenção sua empresa conta com <b><span id="novos"><?= $novos?></span> novos pedidos.</b></p>
                    <a href="/pedidos/novos" class="btn btn-success">Iniciar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-danger">
                    <h5 class="card-title"><i class="fas fa-location-arrow"></i> Em produção</h5>
                    <p class="card-text">Existem <b><?= $producao ?> pedidos em produção</b> na sua empresa neste momento.</p>
                    <a href="/pedidos/producao" class="btn btn-danger">Acompanhar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-info">
                    <h5 class="card-title"><i class="fas fa-mug-hot"></i> Aguardando coleta</h5>
                    <p class="card-text"><b><span id="coleta"><?= $coleta?></span> pedidos estão prontos e aguardando o cliente buscar</b> na sua empresa.</p>
                    <a href="/pedidos/coleta" class="btn btn-info">Visualizar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-primary">
                    <h5 class="card-title"><i class="fas fa-motorcycle"></i> Pronto para entrega</h5>
                    <p class="card-text"><b><span id="entrega"><?= $entrega?></span> pedidos estão aguardando sair para entrega</b> na sua empresa.</p>
                    <a href="/pedidos/entrega" class="btn btn-primary">Acompanhar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-warning">
                    <h5 class="card-title"><i class="fas fa-road"></i> Em rota de entrega</h5>
                    <p class="card-text"><b><span id="emRota"><?= $emRota?></span> pedidos estão sendo entregues</b> pelo seus entregadores</p>
                    <a href="/pedidos/em-rota" class="btn btn-warning">Visualizar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-default">
                    <h5 class="card-title"><i class="fas fa-smile-wink"></i> Finalizados</h5>
                    <p class="card-text">Sua empresa possui <b><span id="entregue"><?= $entregue?></span> pedidos finalizados.</b></p>
                    <a href="/pedidos/entregues" class="btn btn-rosa">Visualizar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->media(['alertaDois.mp3'], ['id' => 'alerta']); ?>
