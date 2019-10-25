<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$tableLocator = new \Cake\ORM\Locator\TableLocator();
?>
<div class="col-sm-12">
    <?=$this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-home')) . ' Todos', array('controller' => 'pedidos', 'action' => 'listAll'), array('escape' => false, 'class' => 'btn btn-sm btn-danger')) ?>
    <h3><?= $title ?></h3>
    <div class="content-filter">
        <form style="padding: 0px!important;" method="get" accept-charset="utf-8" action="/pedidos/entrega">
            <div class="input text">
                <input type="text" name="pedido/id" class="form-control" autocomplete="off" placeholder="Pesquisar #" id="pedido-id">
            </div>
            <div class="input text">
                <input type="text" name="user/nome_completo" class="form-control" autocomplete="off" placeholder="Pesquisar Cliente" id="user-nome-completo">
            </div>
            <button class="btn btn-sm btn-success" style="margin-right: 3px;" type="submit"><i class="fas fa-search"></i> Pesquisar</button>
        </form>
    </div>
    <div class="row">
        <?php
        /** @var $pedido \App\Model\Entity\Pedido */
        foreach ($pedidos as $pedido){
            $entrega = $pedido->getEntrega();
            $entregador = $tableLocator->get('Users')->find()->where(['id'=> $entrega->user_id])->first(); ?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><i class="fas fa-user-alt"></i>&nbsp;<?= $pedido->cliente ?></h6>
                        <p class="card-text">
                            Identificador Pedido: <?= $pedido->id?>
                            <br>
                            Entregador: <?= ($entregador->nome_completo ? $entregador->nome_completo : 'Não definido') ?>
                            <br>
                            Data/Hora: <?= $pedido->data_pedido->format('d/m/Y H:i:s')?>
                            <br>
                            Tempo produção estimado: <?= $pedido->tempo_producao_aproximado_minutos?>
                            <br>
                            Valor Total: R$<?= ($pedido->getValorTotal())?>
                        </p>
                        <?= $this->Html->link(__(''), ['action' => 'setSaiuParaEntrega', $pedido->id], ['class' => 'fas fa-motorcycle btn btn-success btn-sm', 'title' => 'Pedido saiu para entrega']) ?>
                        <?= $this->Html->link(__(''), ['controller' => 'PedidosEntregas','action' => 'setEntregador',  $entrega->id], ['class' => 'far fa-address-card btn btn-warning btn-sm', 'title' => 'Definir entregador']) ?>
                        <?= $this->Html->link(__(''), ['action' => 'view', $pedido->id], ['class' => 'fas fa-eye btn btn-info btn-sm', 'title' => 'Visualizar']) ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
