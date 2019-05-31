<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>Listagem referentes a dados deste mês.</span>
    </div>
    <?= $this->Html->link(__('Gerar Comissões'), ['controller' => 'Financeiro', 'action' => 'comissaoEntregador'], ['class' => 'btn btn-success'])?>
    <h3>Métricas de entregas deste mês</h3>
    <div class="row">
        <?php
        /** @var $pedido \App\Model\Entity\Pedido */
        foreach ($entregas as $entrega) {
            ?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><i class="fas fa-user"></i> <?= $entrega['nome_completo'] ?></h6>
                        <p class="card-text">
                            <b>Entregas realizadas:</b> <?= $entrega['quantidade'] ?>
                            <br>
                            <b>Valor total das entregas:</b> <?= $entrega['valor'] ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
