<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PedidosEntrega[]|\Cake\Collection\CollectionInterface $pedidosEntregas
 */
?>
<div class="col-sm-12">
    <h3><?= __('Pedidos Entregas') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($pedidosEntregas);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#Pedido', 'pedido/id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor Entrega', 'valor_entrega', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('#Endereco', 'endereco/id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Entregador', 'user/nome_completo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->addActionRow('', ['action' => 'setEntregador'], ['class' => 'far fa-address-card btn btn-warning btn-sm', 'title' => 'Definir Entregador'], false, 'id');
    $dataGrid->display();
    ?>
</div>
