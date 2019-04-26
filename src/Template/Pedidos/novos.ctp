<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$tableLocator = new \Cake\ORM\Locator\TableLocator();
?>
<div class="col-sm-12">
    <h3><?= $title ?></h3>
    <div class="content-filter">
        <form style="padding: 0px!important;" method="get" accept-charset="utf-8" action="/pedidos/novos">
            <div class="input text">
                <input type="text" name="pedido/id" class="form-control" autocomplete="off" placeholder="Pesquisar #" id="pedido-id">
            </div>
            <div class="input text">
                <input type="text" name="user/nome_completo" class="form-control" autocomplete="off" placeholder="Pesquisar Cliente" id="user-nome-completo"></div>
            <div class="input text">
                <input type="text" name="formas_pagamento/nome" class="form-control" autocomplete="off" placeholder="Pesquisar Pagamento" id="formas-pagamento-nome">
            </div>
            <div class="input text">
                <input type="text" name="valor_total_cobrado" class="form-control" autocomplete="off" placeholder="Pesquisar Valor Total" id="valor-total-cobrado">
            </div>
            <div class="input text">
                <input type="text" name="troco_para" class="form-control" autocomplete="off" placeholder="Pesquisar Troco Para" id="troco-para">
            </div>
            <button class="btn btn-sm btn-success" style="margin-right: 3px;" type="submit"><i class="fas fa-search"></i> Pesquisar</button>
        </form>
    </div>
    <div class="row">
    <?php
    /** @var $pedido \App\Model\Entity\Pedido */
    foreach ($pedidos as $pedido){
        /** @var $entrega \App\Model\Entity\PedidosEntrega*/
        $entrega = $tableLocator->get('PedidosEntregas')->find()->where(['pedido_id'=> $pedido->id])->first(); ?>
      <div class="col-sm-4">
          <div class="card">
              <div class="card-body">
                  <h6 class="card-title"><i class="fas fa-user-alt"></i>&nbsp;<?= $pedido->user->nome_completo ?></h6>
                  <p class="card-text">
                      Identificador Pedido: <?= $pedido->id?>
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
                  <?= $this->Html->link(__(''), ['action' => 'confirmar', $pedido->id], ['class' => 'far fa-check-square btn btn-success btn-sm', 'title' => 'Confirmar/Rejeitar o pedido']) ?>
              </div>
          </div>
      </div>
    <?php } ?>
    </div>
</div>
