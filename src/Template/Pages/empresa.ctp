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
/** @var $empresa \App\Model\Entity\Empresa*/
$empresa = $empresaUtils->getEmpresaBaseModel();
/** @var $empresaEndereco \App\Model\Entity\EnderecosEmpresa*/
$empresaEndereco = $empresaUtils->getEmpresaBaseEnderecoModel();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $siteUtils->ambiguousHeadImportsSite() ?>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php $siteUtils->menuSite() ?>
<?= $flash->render() ?>
<!-- Page Content -->
<div style="margin-top: 70px;" class="container">
    <div class="col-sm-12" style="text-align: center">
        <h2>Dados Legais</h2>
        <h5>Nome Fantasia: <?= $empresa->nome_fantasia?></h5>
        <h5>CNPJ: <?= $empresa->cnpj?></h5>
        <h5>IE: <?= $empresa->ie?></h5>
        <h2>Endereço</h2>
        <h5>Rua: <?= $empresaEndereco->rua?></h5>
        <h5>Bairro: <?= $empresaEndereco->bairro?></h5>
        <h5>Número: <?= $empresaEndereco->numero?></h5>
        <h5>CEP: <?= $empresaEndereco->cep?></h5>
        <h5>Cidade: <?= $empresaEndereco->cidade?></h5>
        <h5>UF: <?= $empresaEndereco->estado?></h5>
        <iframe src="<?= $empresaUtils->getEmpresaBaseEnderecoIFrameSrc()?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        <h2>Contatos</h2>
    </div>
</div>
<style>
    html, body {
        height: 100%;
    }
    body {
        display: flex;
        flex-direction: column;
    }
    .footer {
        flex-shrink: 0;
    }
</style>
</body>
</html>
