<?php
$empresaUtils = new \App\Model\Utils\EmpresaUtils();
?>
<div style="padding: 150px" class="text-center">
    <h4>Bem-Vindo ao Ladelivery <strong><?= $empresaUtils->getUserName()?></strong></h4>
    <?= $this->Html->link(__(' Estou com problemas'), ['action' => 'display', 'suporte', $pedido->id], ['class' => 'fas fa-exclamation-triangle btn btn-danger btn-sm', 'title' => 'Suporte']) ?>
</div>
