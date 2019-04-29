<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$tableLocator = new \Cake\ORM\Locator\TableLocator();
/** @var $pedido \App\Model\Entity\Pedido */
$entrega = $tableLocator->get('PedidosEntregas')->find()->where(['pedido_id' => $pedido->id])->first();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><?= \App\Model\Utils\EmpresaUtils::NOME_EMPRESA_LOJA ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-home')) . ' Início', array('controller' => 'pages', 'action' => ''), array('escape' => false, 'class' => 'nav-link')) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')) . ' Categorias', array('controller' => 'pages', 'action' => 'categorias'), array('escape' => false, 'class' => 'nav-link')) ?>
                </li>
                <?php if (!isset($_SESSION['Auth']['User']['id'])) { ?>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-in-alt')) . ' Entrar', array('controller' => 'users', 'action' => 'login'), array('escape' => false, 'class' => 'nav-link')) ?>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-user-circle')) . ' Minha Conta', array('controller' => 'users', 'action' => 'profile/' . $_SESSION['Auth']['User']['id']), array('escape' => false, 'class' => 'nav-link')) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-shopping-cart')) . ' Carrinho', array('controller' => 'pages', 'action' => 'carrinho?' . $_SESSION['Auth']['User']['id']), array('escape' => false, 'class' => 'nav-link')) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-out-alt')) . ' Sair', array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'class' => 'nav-link')) ?>
                    </li>
                <?php } ?>
        </div>
    </div>
</nav>
<div style="margin-top: 67px;" class="container">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/pedidos/meus-pedidos" class="btn btn-success"><i class="fas fa-cart-arrow-down"></i> Meus Pedidos</a>
    </div>
    <br>
    <br>
    <div class="form-horizontal">
        <div class="form-group">
            <h6 class="col-sm-3">#Pedido:</h6>
            <span><?= $pedido->id ?></span>
        </div>
        <div class="form-group">
            <h6 class="col-sm-3">Tempo de produção aprox.:</h6>
            <span><?= $pedido->tempo_producao_aproximado_minutos ?> min</span>
        </div>
        <div class="form-group">
            <h6 class="col-sm-3">Data/Hora:</h6>
            <span><?= $pedido->data_pedido->format('d/m/Y H:i:s') ?> min</span>
        </div>
    </div>
    <br>
    <br>
    <?php if ($entrega) { ?>
        <div class="col-sm-12">
            <?php if ($pedido->status_pedido == \App\Model\Entity\Pedido::STATUS_REJEITADO) { ?>
                <div class="icon-item">
                    <i class="fas fa-times-circle fa-fw"></i>
                </div>
            <?php } else { ?>
                <div class="icon-item">
                    <i class="fas fa-stopwatch fa-fw"></i>
                </div>
            <?php } ?>
            <div class="icon-item">
                <i class="fas fa-blender fa-fw"></i>
            </div>
            <div class="icon-item">
                <i class="fas fa-motorcycle fa-fw"></i>
            </div>
            <div class="icon-item">
                <i class="fas fa-road fa-fw"></i>
            </div>
            <div class="icon-item">
                <i class="fas fa-smile-wink fa-fw"></i>
            </div>
        </div>
        <div class="col-sm-12">
            <?php
            switch ($pedido->status_pedido) {
                case \App\Model\Entity\Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA:
                    ?>
                    <div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 20%"></div>
                        </div>
                    </div>
                    <?php
                    break;
                case \App\Model\Entity\Pedido::STATUS_REJEITADO:
                    ?>
                    <div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 20%"></div>
                        </div>
                    </div>
                    <?php
                    break;
                case \App\Model\Entity\Pedido::STATUS_EM_PRODUCAO:
                    ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                             role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                             style="width: 40%"></div>
                    </div>
                    <?php
                    break;
                case \App\Model\Entity\Pedido::STATUS_AGUARDANDO_ENTREGADOR:
                    ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                             role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                             style="width: 60%"></div>
                    </div>
                    <?php
                    break;
                case \App\Model\Entity\Pedido::STATUS_SAIU_PARA_ENTREGA:
                    ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                             role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                             style="width: 80%"></div>
                    </div>
                    <?php
                    break;
                case \App\Model\Entity\Pedido::STATUS_ENTREGUE:
                    ?>
                    <div class="progress">
                        <div class="progress-bar bg-success"
                             role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                             style="width: 100%"></div>
                    </div>
                    <?php
                    break;
            }
            ?>
        </div>
        <br>
        <br>
        <div class="col-sm-12 alert alert-info">
            <div class="icon-obs">
                <i class="fas fa-times-circle fa-fw"></i> - O pedido não foi aceito pela empresa.
            </div>
            <div class="icon-obs">
                <i class="fas fa-stopwatch fa-fw"></i> - O pedido está aguardando aprovação da empresa.
            </div>
            <div class="icon-obs">
                <i class="fas fa-blender fa-fw"></i> - O pedido está sendo produzido.
            </div>
            <div class="icon-obs">
                <i class="fas fa-motorcycle fa-fw"></i> - Produção concluída, aguardando entregador coletar seu pedido.
            </div>
            <div class="icon-obs">
                <i class="fas fa-road fa-fw"></i> - Pedido coletado, saiu para entrega.
            </div>
            <div class="icon-obs">
                <i class="fas fa-smile-wink fa-fw"></i> - Entregue ao cliente.
            </div>
        </div>
    <?php } else { ?>
        <div class="col-sm-12">
            <?php if ($pedido->status_pedido == \App\Model\Entity\Pedido::STATUS_REJEITADO) { ?>
                <div class="icon-item four-div">
                    <i class="fas fa-times-circle fa-fw"></i>
                </div>
            <?php } else { ?>
                <div class="icon-item four-div">
                    <i class="fas fa-stopwatch fa-fw"></i>
                </div>
            <?php } ?>
            <div class="icon-item four-div">
                <i class="fas fa-blender fa-fw"></i>
            </div>
            <div class="icon-item four-div">
                <i class="fas fa-clock fa-fw"></i>
            </div>
            <div class="icon-item four-div">
                <i class="fas fa-smile-wink fa-fw"></i>
            </div>
        </div>
        <div class="col-sm-12">
            <?php
            switch ($pedido->status_pedido) {
                case \App\Model\Entity\Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA:
                    ?>
                    <div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 25%"></div>
                        </div>
                    </div>
                    <?php
                    break;
                case \App\Model\Entity\Pedido::STATUS_REJEITADO:
                    ?>
                    <div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 25%"></div>
                        </div>
                    </div>
                    <?php
                    break;
                case \App\Model\Entity\Pedido::STATUS_EM_PRODUCAO:
                    ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                             role="progressbar"
                             aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                    </div>
                    <?php
                    break;
                case \App\Model\Entity\Pedido::STATUS_AGUARDANDO_COLETA_CLIENTE:
                    ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                             role="progressbar"
                             aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                    </div>
                    <?php
                    break;
                case \App\Model\Entity\Pedido::STATUS_ENTREGUE:
                    ?>
                    <div class="progress">
                        <div class="progress-bar bg-success"
                             role="progressbar"
                             aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                    <?php
                    break;
            }
            ?>
        </div>
        <br>
        <br>
        <div class="col-sm-12 alert alert-info">
            <div class="icon-obs">
                <i class="fas fa-times-circle fa-fw"></i> - O pedido não foi aceito pela empresa.
            </div>
            <div class="icon-obs">
                <i class="fas fa-stopwatch fa-fw"></i> - O pedido está aguardando aprovação da empresa.
            </div>
            <div class="icon-obs">
                <i class="fas fa-blender fa-fw"></i> - O pedido está sendo produzido.
            </div>
            <div class="icon-obs">
                <i class="fas fa-clock fa-fw"></i> - Produção concluída, você pode retirar o pedido na empresa.
            </div>
            <div class="icon-obs">
                <i class="fas fa-smile-wink fa-fw"></i> - Entregue ao cliente
            </div>
        </div>
    <?php } ?>
</div>
<style>
    .icon-item {
        width: 20%;
        float: left;
        text-align: right;
    }

    .icon-obs{
        padding: 15px;
        color: black!important;
    }

    .four-div {
        width: 25% !important;
    }

    .form-group{
        margin-bottom: 4px!important;
    }
    h6{
        padding-left: 0px!important;
    }
</style>
