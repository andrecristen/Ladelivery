<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$tableLocator = new \Cake\ORM\Locator\TableLocator();
$statusList = \App\Model\Entity\Pedido::getDeliveryStatusList();
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <h3 style="text-align: center">Histórico completo de pedidos</h3>
    <div class="row">
        <?php
        /** @var $pedido \App\Model\Entity\Pedido */
        foreach ($pedidos as $pedido){
            /** @var $entrega \App\Model\Entity\PedidosEntrega*/
            $entrega = $pedido->getEntrega()?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><i class="fas fa-clipboard-list"></i></h6>
                        <p class="card-text">
                            <b>#Pedido:</b> <?= $pedido->id?>
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
                                <b>Entrega: R$</b><?= $entrega->valor_entrega ?>
                            <?php }else{ ?>
                                <b>Entrega:</b> Entrega não contratada
                            <?php }?>
                            <br>
                            <b>Valor Total: R$</b><?= $pedido->getValorTotal()?>
                        </p>
                        <?= $this->Html->link(__(' Visualizar Status'), ['action' => 'verStatus', $pedido->id], ['class' => 'far fa-eye btn btn-info btn-sm', 'title' => 'Visualizar Pedido']) ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<style>
    .col-sm-4{
        margin-bottom: 15px;
    }
</style>

