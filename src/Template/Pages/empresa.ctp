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
/** @var $horariosAtendimento \App\Model\Entity\HorariosAtendimento[]*/
$horariosAtendimento = $tableLocator->get('HorariosAtendimentos')->find()->where(['empresa_id' => $empresaUtils->getEmpresaBase()])->orderAsc('dia_semana')->orderAsc('turno');
$diaSemanaList = \App\Model\Entity\HorariosAtendimento::getDiaSemanaList();
$turnoList = \App\Model\Entity\HorariosAtendimento::getTurnoList();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $siteUtils->ambiguousHeadImportsSite() ?>
    <title>Sobre Nós</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php $siteUtils->menuSite() ?>
<?= $flash->render() ?>
<!-- Page Content -->
<div style="margin-top: 70px;" class="container">
    <div class="col-sm-12" style="text-align: center">
        <iframe src="<?= $empresaUtils->getEmpresaBaseEnderecoIFrameSrc()?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        <h2><i class="fas fa-gavel"></i> Dados Legais</h2>
        <h5>Nome Fantasia: <?= $empresa->nome_fantasia?></h5>
        <h5>CNPJ: <?= $empresa->cnpj?></h5>
        <h5>IE: <?= $empresa->ie?></h5>
        <br>
        <h2><i class="fas fa-map-marker-alt"></i> Endereço</h2>
        <h5>Rua: <?= $empresaEndereco->rua?></h5>
        <h5>Bairro: <?= $empresaEndereco->bairro?></h5>
        <h5>Número: <?= $empresaEndereco->numero?></h5>
        <h5>CEP: <?= $empresaEndereco->cep?></h5>
        <h5>Cidade: <?= $empresaEndereco->cidade?></h5>
        <h5>UF: <?= $empresaEndereco->estado?></h5>
        <br>
        <h2><i class="fas fa-comment"></i> Contatos</h2>
        <?php
        $contatos = json_decode($empresa->contatos, true);
        $siteUtils->montaContatos($contatos);
        ?>
        <br>
        <h2><i class="fas fa-clock"></i> Horários de Atendimento</h2>
        <?php foreach ($horariosAtendimento as $horario){
            ?>
            <h5><?= $diaSemanaList[$horario->dia_semana]?> - <?= $horario->hora_inicio->format('H:i')?>h às  <?= $horario->hora_fim->format('H:i')?>h</h5>
        <?php }?>
    </div>
</div>
<br>
<br>
<br>
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

    h2{
        border-bottom: 3px solid rgba(34, 123, 218, 0.87);
        padding: 4px;
    }
    .container a{
        color: #000000!important;
    }
</style>
</body>
</html>
