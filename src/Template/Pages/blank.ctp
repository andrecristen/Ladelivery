<?php
$empresaUtils = new \App\Model\Utils\EmpresaUtils();
if($empresaUtils->getUserTipo() == \App\Model\Entity\User::TIPO_CLIENTE || !$empresaUtils->getUserId()){
    return;
}
?>
<?= $this->Html->css('painel.css') ?>
<div style="top: 75px" class="container col-sm-12">
    <fieldset class="text-center">
        <legend>Bem-Vindo ao LaDelivery <strong><?= $empresaUtils->getUserName()?></strong></legend>
    </fieldset>
    <br/>
    <div class="row">
        <div class="col-sm-3">
            <a href="/pedidos/index">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pedidos</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="/pedidos/comandas">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Comandas</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sticky-note fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="/financeiro/painel">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Painel Financeiro</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-3">
            <a href="/pages/suporte">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Estou Com Problemas</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
