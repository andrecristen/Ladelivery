<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<style>
    .col-sm-4{
        margin-bottom: 15px;
    }
    .btn-warning{
        color: #ffffff;
    }
    .btn-warning:hover{
        color: #ffffff;
    }
</style>
<div class="col-sm-12">
    <?= $this->Html->link(__(' Visualização em Lista'), ['action' => 'index'], ['class' => 'fas fa-list btn btn-info btn-sm', 'title' => 'Visualizar da maneira classica']) ?>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-success">
                    <h5 class="card-title"><i class="fas fa-gift"></i> Novos</h5>
                    <p class="card-text">Atenção sua empresa conta com <?= $novos?> novos pedidos.</p>
                    <a href="/pedidos/novos" class="btn btn-success">Iniciar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-danger">
                    <h5 class="card-title"><i class="fas fa-location-arrow"></i> Em produção</h5>
                    <p class="card-text">Existem <?= $producao ?> pedidos em produção na sua empresa neste momento.</p>
                    <a href="/pedidos/producao" class="btn btn-danger">Acompanhar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-info">
                    <h5 class="card-title"><i class="fas fa-mug-hot"></i> Aguardando coleta</h5>
                    <p class="card-text"><?= $coleta?> pedidos estão prontos e aguardando o cliente buscar na sua empresa.</p>
                    <a href="/pedidos/coleta" class="btn btn-info">Visualizar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-primary">
                    <h5 class="card-title"><i class="fas fa-motorcycle"></i> Pronto para entrega</h5>
                    <p class="card-text"><?= $entrega?> pedidos estão aguardando sua empresa entregá-los</p>
                    <a href="/pedidos/entrega" class="btn btn-primary">Acompanhar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-warning">
                    <h5 class="card-title"><i class="fas fa-road"></i> Em rota de entrega</h5>
                    <p class="card-text"><?= $emRota?> pedidos estão sendo entregues</p>
                    <a href="/pedidos/em-rota" class="btn btn-warning">Visualizar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-default">
                    <h5 class="card-title"><i class="fas fa-smile-wink"></i> Finalizados</h5>
                    <p class="card-text">Sua empresa possui <?= $entregue?> pedidos finalizados.</p>
                    <a href="/pedidos/entregues" class="btn btn-rosa">Visualizar</a>
                </div>
            </div>
        </div>
    </div>
</div>
