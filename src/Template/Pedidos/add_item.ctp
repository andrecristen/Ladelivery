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
    <div class="alert alert-info">
        <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-check')) . ' '.$message, array('controller' => 'Pedidos', 'action' => 'confirmarAbertura/'.$pedido->id), array('escape' => false, 'class' => 'btn btn-danger'));?>
        <br>
        <strong>Confirme apenas após adicionar todos os itens.</strong>
    </div>
    <div class="row">
        <?php $siteUtils->createFormAdicionarProduto(false, $pedido->id)?>
        <?php $siteUtils->createProdutosCategoria(false, false, true, false,'Adicionar')?>
    </div>
</div>
<style>
    li .selected{
        background: #7fffd459 !important;
    }
</style>
