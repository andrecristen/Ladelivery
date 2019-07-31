<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$statusList = \App\Model\Entity\Pedido::getDeliveryStatusList();
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
echo $this->Html->css('status.css' . $cacheVersion);
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <h2 style="text-align: center">Em Andamento</h2>
    <div style="margin-bottom: 15px!important;" class="col-sm-12">
        <?php
        $pedidosCount = 0;
        /** @var $pedido \App\Model\Entity\Pedido */
        foreach ($pedidos as $pedido){
            $pedidosCount++;
            /** @var $entrega \App\Model\Entity\PedidosEntrega*/
            $entrega = $pedido->getEntrega()?>
            <div class="col-sm-12">
                <h4 style="text-align: center">Pedido: #<?= $pedido->id?></h4>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card min-heigth padding">
                        <p class="card-text">
                            <br>
                            <b>Data/Hora:</b> <?= $pedido->data_pedido->format('d/m/Y H:i:s')?>
                            <br>
                            <b>Tempo produção estimado:</b> <?= $pedido->tempo_producao_aproximado_minutos?>
                            <br>
                            <b>Situação :</b> <?= $statusList[$pedido->status_pedido] ?>
                            <br>
                            <b>Acréscimos: R$</b> <?= $pedido->valor_acrescimo ?>
                            <br>
                            <b>Descontos: R$</b> <?= $pedido->valor_desconto ?>
                            <br>
                            <?php if($entrega){?>
                                <b>Entrega: R$</b><?= $entrega->valor_entrega ?></span>
                            <?php }else{ ?>
                                <b>Entrega: Entrega não contratada</b>
                            <?php }?>
                            <br>
                            <b>Valor Total: R$</b><?= $pedido->getValorTotal()?>
                        </p>
                        <?= $this->Html->link(__(' Acompanhar Pedido'), ['action' => 'verStatus', $pedido->id], ['class' => 'far fa-eye btn btn-info btn-sm', 'title' => 'Visualizar Pedido']) ?>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card min-heigth padding">
                        <span style="font-weight: bold">Situação</span>
                        <br/>
                        <br/>
                        <br/>
                        <?php $siteUtils->createStatusPedido($pedido, false)?>
                        <br/>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
    <?php
    if($pedidosCount == 0){
        echo '<div style="text-align: center" class="alert alert-danger">Você não possui nenhum pedido em andamento!</div>';
    }
    ?>
    <?php if($pedidosHistorico > 0){
        echo '<br/>';
        echo '<div style="text-align: center">';
        echo $this->Html->link(__(' Visualizar Histórico (+'.$pedidosHistorico.')'), ['action' => 'meusPedidosHistorico'], ['class' => 'fas fa-list btn btn-primary', 'title' => 'Visualizar Histórico Completo']);
        echo '</div>';
    }
    ?>
    <br>
</div>
<style>
</style>