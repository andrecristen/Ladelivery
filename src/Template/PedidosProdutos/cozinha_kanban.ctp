<?php
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
echo $this->Html->css('kanban.css'.$cacheVersion);
echo $this->Html->script('kanban-produto.js'.$cacheVersion);
$siteUtils = new \App\Model\Utils\SiteUtils();
?>
<div class="col-sm-12">
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-primary kanban-col">
                <div class="panel-heading">
                    <h5>Aguardando Produção</h5>
                </div>
                <div class="panel-body">
                    <div id="TODO" class="kanban-centered">
                       <?php foreach ($pedidosProdutos[\App\Model\Entity\PedidosProduto::STATUS_EM_FILA_PRODUCAO] as $pedidoProduto){
                           $siteUtils->createQuadrosKanbanPedidosProdutos($pedidoProduto);
                       }?>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary kanban-col">
                <div class="panel-heading">
                    <h5>Em Produção</h5>
                </div>
                <div class="panel-body">
                    <div id="DOING" class="kanban-centered">
                        <?php foreach ($pedidosProdutos[\App\Model\Entity\PedidosProduto::STATUS_EM_PRODUCAO] as $pedidoProduto){
                            $siteUtils->createQuadrosKanbanPedidosProdutos($pedidoProduto);
                        }?>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary kanban-col">
                <div class="panel-heading">
                    <h5>Produção Concluída</h5>
                </div>
                <div class="panel-body">
                    <div id="DONE" class="kanban-centered">
                        <?php foreach ($pedidosProdutos[\App\Model\Entity\PedidosProduto::STATUS_PRODUCAO_CONCLUIDA] as $pedidoProduto){
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
