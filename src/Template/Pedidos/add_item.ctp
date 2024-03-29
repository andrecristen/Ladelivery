<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

$siteUtils = new \App\Model\Utils\SiteUtils();
$cacheControl = new \App\Model\Utils\CacheControl();
$siteUtils::setDontImportAdminScripts(true);
$message = 'Confirmar Abertura do Pedido';
if($pedido->tipo_pedido == \App\Model\Entity\Pedido::TIPO_PEDIDO_COMANDA){
    $message = 'Confirmar Abertura da Comanda';
}
?>
<script src="/ladev/alert/alertify.min.js<?= h($cacheControl->getCacheVersion()) ?>"></script>
<link rel="stylesheet" href="/ladev/alert/css/alertify.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
<link rel="stylesheet" href="/ladev/alert/css/themes/bootstrap.min.css<?= h($cacheControl->getCacheVersion()) ?>" />
<?php echo $this->Html->script('produto.js'); ?>
<?php echo $this->Html->script('tabs.js'); ?>
<?php echo $this->Html->css('tabs.css'); ?>
<?php echo $this->Html->css('bloq.css'); ?>
<div class="col-sm-12">
    <div class="div-ajax-carregamento-pagina">
        <div id="text">Carregando Informações<br/><i class="fas fa-spinner fa-spin"></i></div>
    </div>
    <?php if ($pedido->status_pedido == \App\Model\Entity\Pedido::STATUS_EM_ABERTURA) { ?>
        <div class="alert alert-info">
            <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-check')) . ' '.$message, array('controller' => 'Pedidos', 'action' => 'confirmarAbertura/'.$pedido->id), array('escape' => false, 'class' => 'btn btn-danger'));?>
            <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-print')) . ' Imprimir', array('controller' => 'Pedidos', 'action' => 'imprimir/'.$pedido->id), array('escape' => false, 'class' => 'btn btn-info'));?>
        </div>
   <?php }else{
        $ambienteVenda = \App\Model\Entity\Produto::VENDA_COMANDA;
        if($pedido->tipo_pedido == \App\Model\Entity\Pedido::TIPO_PEDIDO_DELIVERY) {
            $ambienteVenda = \App\Model\Entity\Produto::VENDA_DELIVERY;
            ?>
            <div class="alert alert-info">
                <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-check')) . ' Concluido', $this->request->referer(), array('escape' => false, 'class' => 'btn btn-danger'));?>
                <br>
            </div>
       <?php }else{ ?>
            <div class="alert alert-info">
                <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-check')) . ' Concluido', $this->request->referer(), array('escape' => false, 'class' => 'btn btn-danger'));?>
                <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-print')) . ' Imprimir', array('controller' => 'Pedidos', 'action' => 'imprimir/'.$pedido->id), array('escape' => false, 'class' => 'btn btn-info'));?>
            </div>
       <?php }?>
    <?php }?>
    <div class="row">
        <?php $siteUtils->createFormAdicionarProduto(false, $pedido->id)?>
        <?php $siteUtils->createProdutosCategoria(false, false, true, false,'Adicionar', $ambienteVenda)?>
    </div>
</div>
<style>
    li .selected{
        background: #7fffd459 !important;
    }
</style>
