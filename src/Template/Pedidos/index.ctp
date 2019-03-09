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
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($pedidos);
    $dataGrid->bloqActionAdd();
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('Cliente', 'user/nome_completo', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Pagamento', 'formas_pagamento/nome', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Valor Total', 'valor_total_cobrado', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->addField('Tempo', 'tempo_producao_aproximado_minutos', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->addField('Data', 'data_pedido', \App\Model\Utils\DataGridLaDev::TYPE_DATE_TIME);
    $dataGrid->addField('Troco Para', 'troco_para', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->addField('Status', 'status_pedido', \App\Model\Utils\DataGridLaDev::TYPE_LIST, $pedidoModel->getDeliveryStatusList());
    $dataGrid->addActionRow('', ['action' => 'confirmar'], ['class' => 'far fa-check-square btn btn-primary btn-sm', 'title' => 'Confirmar/Rejeitar Recebimento do Pedido'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'alterarSituacao'], ['class' => 'fa fa-history btn btn-success btn-sm', 'title' => 'Alterar Situacao do Pedido'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'imprimir'], ['class' => 'fa fa-print btn btn-info btn-sm', 'title' => 'Imprimir Guias de Pedido'], false, 'id');
    $dataGrid->alterWidth('valor_total_cobrado', 100, $dataGrid::TYPE_WIDTH_PX);
    $dataGrid->alterWidth('tempo_producao_aproximado_minutos', 100, $dataGrid::TYPE_WIDTH_PX);
    $dataGrid->alterWidth('data_pedido', 150, $dataGrid::TYPE_WIDTH_PX);
    $dataGrid->alterWidth('troco_para', 100, $dataGrid::TYPE_WIDTH_PX);
    $dataGrid->alterWidth('formas_pagamento/nome', 100, $dataGrid::TYPE_WIDTH_PX);
    $dataGrid->display();
    ?>
</div>