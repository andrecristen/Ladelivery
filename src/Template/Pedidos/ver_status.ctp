<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
/** @var $pedido \App\Model\Entity\Pedido */
$entrega = $pedido->getEntrega();
$listStatus = \App\Model\Entity\Pedido::getDeliveryStatusList();
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
echo $this->Html->css('status.css' . $cacheVersion);
?>
<div style="margin-top: 67px;" class="container">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/pedidos/meus-pedidos" class="btn btn-success"><i class="fas fa-cart-arrow-down"></i> Pedidos Em Andamento</a>
        <a href="/pedidos/meus-pedidos-historico" class="btn btn-primary"><i class="fas fa-history"></i> Histórico Completo</a>
    </div>
    <br>
    <br>
    <div class="form-horizontal form-desc">
        <div class="form-group">
            <span>#Pedido:</span>
            <label><?= $pedido->id ?></label>
        </div>
        <div class="form-group">
            <span>Tempo de produção estimado:</span>
            <label><?= $pedido->tempo_producao_aproximado_minutos ?> min</label>
        </div>
        <div class="form-group">
            <span>Data/Hora:</span>
            <label><?= $pedido->data_pedido->format('d/m/Y H:i:s') ?></label>
        </div>
        <div class="form-group">
            <span>Acréscimos R$:</span>
            <label><?=  $this->Number->format($pedido->valor_acrescimo) ?></label>
        </div>
        <div class="form-group">
            <span>Descontos R$:</span>
            <label><?=  $this->Number->format($pedido->valor_desconto) ?></label>
        </div>
        <?php if($entrega){?>
            <div class="form-group">
                <span>Entrega R$:</span>
                <label><?=  $this->Number->format($entrega->valor_entrega) ?></label>
            </div>
        <?php }else{ ?>
            <div class="form-group">
                <span>Entrega:</span>
                <label>Entrega não contratada</label>
            </div>
        <?php }?>
        <div class="form-group">
            <span>Valor R$:</span>
            <label><?= $this->Number->format($pedido->getValorTotal())?></label>
        </div>
    </div>
    <br>
    <br>
    <?php $siteUtils->createStatusPedido($pedido)?>
</div>
