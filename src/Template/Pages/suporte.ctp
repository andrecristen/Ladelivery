<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$siteUtils = new \App\Model\Utils\SiteUtils();
$empresaUtils = new \App\Model\Utils\EmpresaUtils();
$isLadev = false;
if($empresaUtils->getUserTipo() == \App\Model\Entity\User::TIPO_CLIENTE || !$empresaUtils->getUserId()){
    $empresa = $empresaUtils->getEmpresaBaseModel();
}else{
    $isLadev = true;
    $empresa = $empresaUtils->getEmpresaSoftwareModel();
}
?>
<div style="text-align: center" class="col-sm-12">
    <?php if($isLadev){ ?>
        <h1>LaDev Sistemas</h1>
    <?php }?>
    <br>
    <?php
    $contatos = json_decode($empresa->contatos, true);
    $siteUtils->montaContatos($contatos);
    ?>
    <?php if($isLadev){ ?>
        <h5><a target="_blank" href="https://ladevsistemas.com.br/"><i class="fas fa-desktop"></i> ladevsistemas.com.br</a></h5>
        <br>
        <h5>Segunda a Sexta - 15h45 às 00h00</h5>
        <h5>Sábados e Domingos - 9h00 às 18h00</h5>
    <?php }?>
</div>
