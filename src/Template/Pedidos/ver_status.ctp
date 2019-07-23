<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
/** @var $pedido \App\Model\Entity\Pedido */
$entrega = $pedido->getEntrega();
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
echo $this->Html->css('status.css' . $cacheVersion);
?>
<div style="margin-top: 67px;" class="container">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/pedidos/meus-pedidos" class="btn btn-success"><i class="fas fa-cart-arrow-down"></i> Meus Pedidos</a>
    </div>
    <br>
    <br>
    <div class="form-horizontal">
        <div class="form-group">
            <span>#Pedido:</span>
            <label><?= $pedido->id ?></label>
        </div>
        <div class="form-group">
            <span>Tempo de produção aprox.:</span>
            <label><?= $pedido->tempo_producao_aproximado_minutos ?> min</label>
        </div>
        <div class="form-group">
            <span>Data/Hora:</span>
            <label><?= $pedido->data_pedido->format('d/m/Y H:i:s') ?></label>
        </div>
    </div>
    <br>
    <br>
    <?php $siteUtils->createStatusPedido($pedido)?>
</div>
