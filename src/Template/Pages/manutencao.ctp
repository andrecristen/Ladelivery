<?php
$empresaUtils = new \App\Model\Utils\EmpresaUtils();
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->ambiguousHeadImportsSite();
$this->layout = false;
?>
<?php if(\App\Model\Utils\EmpresaUtils::EM_MANUTENCAO){ ?>
    <div style="padding: 80px">
        <div class="row">
            <?php echo $this->Html->image('empresa/logoLadevNew.svg', ['class' => 'img-fluid', 'width' => '100px', 'heigth' => '100px']); ?>
        </div>
        <hr>
        <h4><strong>Prezado visitante</strong></h4>
        <p class="text-left">
            Este site está temporariamente indisponivel para acesso,
            estamos passado por uma manutenção interna de sistema, o que impossibilita seu uso normal.
            Pedimos desculpas e calma, pois em cerca de <strong><?= \App\Model\Utils\EmpresaUtils::HORAS_PREVISTAS_MANUTENCAO?> hora(s)</strong> normalizaremos o serviço.
            <br>
        <p class="text-right"><b>Atenciosamente,</b><br>
            Equipe LaDev Sistemas e <?= $empresaUtils::NOME_EMPRESA_LOJA?>.</p>
        <hr>
    </div>
<?php }else{ ?>
    <div style="padding: 80px">
        <div class="row">
            <?php echo $this->Html->image('empresa/logoLadevNew.svg', ['class' => 'img-fluid', 'width' => '100px', 'heigth' => '100px']); ?>
        </div>
        <hr>
        <h4><strong>Site em funcionamento normal</strong></h4>
        <p class="text-left">
           Nenhuma manutenção está ocorrendo neste serviço.<br>
        <p class="text-right"><b>Atenciosamente,</b><br>
            Equipe LaDev Sistemas e <?= $empresaUtils::NOME_EMPRESA_LOJA?>.</p>
        <hr>
    </div>
<?php }?>

