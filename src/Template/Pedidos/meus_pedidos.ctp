<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$tableLocator = new \Cake\ORM\Locator\TableLocator();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">LaDelivery</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-home')).' Início', array('controller' => 'pages', 'action' => ''), array('escape' => false , 'class' => 'nav-link')) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).' Categorias', array('controller' => 'pages', 'action' => 'categorias'), array('escape' => false , 'class' => 'nav-link')) ?>
                </li>
                <?php if (!isset($_SESSION['Auth']['User']['id'])) { ?>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-in-alt')).' Entrar', array('controller' => 'users', 'action' => 'login'), array('escape' => false , 'class' => 'nav-link')) ?>
                    </li>
                <?php }else{ ?>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-user-circle')).' Minha Conta', array('controller' => 'users', 'action' => 'profile/'.$_SESSION['Auth']['User']['id']), array('escape' => false , 'class' => 'nav-link')) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-shopping-cart')).' Carrinho', array('controller' => 'pages', 'action' => 'carrinho?'.$_SESSION['Auth']['User']['id']), array('escape' => false , 'class' => 'nav-link')) ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-out-alt')).' Sair', array('controller' => 'users', 'action' => 'logout'), array('escape' => false , 'class' => 'nav-link')) ?>
                    </li>
                <?php } ?>
        </div>
    </div>
</nav>
<div style="margin-top: 67px;" class="col-sm-12">
    <h3>Seus Pedidos</h3>
    <div class="row">
        <?php
        /** @var $pedido \App\Model\Entity\Pedido */
        foreach ($pedidos as $pedido){
            /** @var $entrega \App\Model\Entity\PedidosEntrega*/
            $entrega = $tableLocator->get('PedidosEntregas')->find()->where(['pedido_id'=> $pedido->id])->first(); ?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><i class="fas fa-clipboard-list"></i></h6>
                        <p class="card-text">
                            #Pedido: <?= $pedido->id?>
                            <br>
                            Data/Hora: <?= $pedido->data_pedido->format('d/m/Y H:i:s')?>
                            <br>
                            Tempo produção estimado: <?= $pedido->tempo_producao_aproximado_minutos?>
                            <br>
                            Acréscimos: R$ <?= $pedido->valor_acrescimo ?>
                            <br>
                            Descontos: R$ <?= $pedido->valor_desconto ?>
                            <br>
                            Produtos: R$ <?= $pedido->valor_total_cobrado ?>
                            <br>
                            <?php if($entrega){?>
                                Entrega: R$<?= $entrega->valor_entrega ?></span>
                                <br>
                                Valor Total: R$<?= ($entrega->valor_entrega + $pedido->valor_total_cobrado + $pedido->valor_acrescimo) - $pedido->valor_desconto?>
                            <?php }else{ ?>
                                Entrega: Entrega não contratada
                                <br>
                                Valor Total: R$<?= ($pedido->valor_total_cobrado + $pedido->valor_acrescimo) - $pedido->valor_desconto?>

                            <?php }?>
                        </p>
                        <?= $this->Html->link(__(''), ['action' => 'verStatus', $pedido->id], ['class' => 'far fa-eye btn btn-success btn-sm', 'title' => 'Visualizar Pedido']) ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
