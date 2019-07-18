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
$empresa = $empresaUtils->getEmpresaBaseModel();
/** @var $notificacoes \App\Model\Entity\Log[]*/
$notificacoes = $tableLocator->get('Logs')->find()->where(['user_id' => $empresaUtils->getUserId(), 'situacao' => \App\Model\Entity\Log::SITUACAO_PENDENTE])->orderDesc('id');
$notificacaoCount = $notificacoes->count();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $siteUtils->ambiguousHeadImportsSite() ?>
    <title>Notificações</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php $siteUtils->menuSite() ?>
<?= $flash->render() ?>
<!-- Page Content -->
<div style="margin-top: 70px;" class="container">
    <?php
    $count = 0;
    foreach ($notificacoes as $notificacao){
        $count++;
        $notificacao->situacao = \App\Model\Entity\Log::SITUACAO_LIDA;
        $tableLocator->get('Logs')->save($notificacao);
        ?>
        <div class="alert alert-success">
            <div class="alert-box">
                <span><?= $notificacao->descricao?></span>
            </div>
            <br/>
        </div>
    <?php }
    if($count == 0){ ?>
        <div style="text-align: center" class="alert alert-info">
            <div class="alert-box">
                <span>Não há novas notificações...</span>
            </div>
            <br/>
        </div>
    <?php } ?>
</div>
</body>
</html>
