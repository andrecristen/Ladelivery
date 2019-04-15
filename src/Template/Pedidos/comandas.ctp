<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pedido[]|\Cake\Collection\CollectionInterface $pedidos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Comandas') ?></h3>
    <?php
    $pedidoModel = new \App\Model\Entity\Pedido();
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($pedidos);
    $dataGrid->bloqActionAdd();
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('Cliente', 'cliente', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor Total', 'valor_total_cobrado', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, '100px'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Tempo de Producao', 'tempo_producao_aproximado_minutos', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, '200px'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Data', 'data_pedido', \App\Model\Utils\DataGridGenerator::TYPE_DATE_TIME, true, true, '150px'));
    $status = new \App\Model\Utils\GridField('Status', 'status_pedido', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $status->setList($pedidoModel->getComandaStatusList());
    $dataGrid->addField($status);
    $dataGrid->addActionRow('', ['action' => 'alterarSituacao'], ['class' => 'fa fa-history btn btn-success btn-sm', 'title' => 'Alterar Situacao do Pedido'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'imprimir'], ['class' => 'fa fa-print btn btn-info btn-sm', 'title' => 'Imprimir Guias de Pedido'], false, 'id');
    $dataGrid->setCallBackActionLimpar('comandas');
    $dataGrid->display();
    ?>
</div>