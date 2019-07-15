<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pedido[]|\Cake\Collection\CollectionInterface $pedidos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Pedidos') ?></h3>
    <?php
    $pedidoModel = new \App\Model\Entity\Pedido();
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($pedidos);
    $dataGrid->bloqActionAdd();
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, '60px', 'pedido/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Cliente', 'user/nome_completo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Pagamento', 'formas_pagamento/nome', \App\Model\Utils\DataGridGenerator::TYPE_TEXT, true, true, '100px'));
    //$dataGrid->addField(new \App\Model\Utils\GridField('Valor Produtos', 'valor_produtos', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, '100px'));
    //$dataGrid->addField(new \App\Model\Utils\GridField('Tempo', 'tempo_producao_aproximado_minutos', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, '100px'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Data', 'data_pedido', \App\Model\Utils\DataGridGenerator::TYPE_DATE_TIME, true, true, '150px'));
    //$dataGrid->addField(new \App\Model\Utils\GridField('Troco Para', 'troco_para', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, '100px'));
    $status = new \App\Model\Utils\GridField('Status', 'status_pedido', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $status->setList($pedidoModel->getDeliveryStatusList());
    $dataGrid->addField($status);
    $dataGrid->addActionRow('', ['action' => 'addItem'], ['class' => 'fas fa-plus-square btn btn-danger btn-sm', 'title' => 'Adicionar Item ao Pedido'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'confirmar'], ['class' => 'far fa-check-square btn btn-primary btn-sm', 'title' => 'Confirmar/Rejeitar Recebimento do Pedido'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'alterarSituacao'], ['class' => 'fa fa-history btn btn-success btn-sm', 'title' => 'Alterar Situacao do Pedido'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'imprimir'], ['class' => 'fa fa-print btn btn-info btn-sm', 'title' => 'Imprimir Guias de Pedido'], false, 'id');
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>