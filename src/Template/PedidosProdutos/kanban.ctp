<?php
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
echo $this->Html->css('kanban.css'.$cacheVersion);
echo $this->Html->script('kanban-produto.js'.$cacheVersion);
$siteUtils = new \App\Model\Utils\SiteUtils();
?>
<script src="/ladev/alert/alertify.min.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
<link rel="stylesheet" href="/ladev/alert/css/alertify.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
<link rel="stylesheet" href="/ladev/alert/css/themes/bootstrap.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
<div class="col-sm-12">
    <h2><?= $title ?></h2>
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-primary kanban-col col-sm-5">
                <div class="panel-heading">
                    <h5>Aguardando Produção</h5>
                </div>
                <div class="panel-body">
                    <div id="panel-<?= \App\Model\Entity\PedidosProduto::STATUS_EM_FILA_PRODUCAO ?>" class="kanban-centered">
                        <?php foreach ($pedidosProdutos[\App\Model\Entity\PedidosProduto::STATUS_EM_FILA_PRODUCAO] as $pedidoProduto){
                            $siteUtils->createQuadrosKanbanPedidosProdutos($pedidoProduto);
                        }?>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary kanban-col col-sm-5">
                <div class="panel-heading">
                    <h5>Em Produção</h5>
                </div>
                <div class="panel-body">
                    <div id="panel-<?= \App\Model\Entity\PedidosProduto::STATUS_EM_PRODUCAO ?>" class="kanban-centered">
                        <?php foreach ($pedidosProdutos[\App\Model\Entity\PedidosProduto::STATUS_EM_PRODUCAO] as $pedidoProduto){
                            $siteUtils->createQuadrosKanbanPedidosProdutos($pedidoProduto);
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-refresh fa-5x fa-spin"></i>
                        <h4>Processando...</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
