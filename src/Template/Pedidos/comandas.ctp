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
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setModel($pedidos);
    $dataGrid->bloqActionAdd();
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addAction('Pedidos', 'abrirComanda', ' Abrir', 'btn btn-primary');
    $dataGrid->addField('Cliente', 'user/nome_completo', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Valor Total', 'valor_total_cobrado', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Tempo de Producao', 'tempo_producao_aproximado_minutos', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Data', 'data_pedido', \App\Model\Utils\DataGridUtils::TYPE_DATE_TIME);
    $dataGrid->addField('Status', 'status_pedido', \App\Model\Utils\DataGridUtils::TYPE_LIST, $pedidoModel->getComandaStatusList());
    $dataGrid->addActionRow('', ['action' => 'alterarSituacao'], ['class' => 'fa fa-history btn btn-success btn-sm', 'title' => 'Alterar Situacao do Pedido'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'imprimir'], ['class' => 'fa fa-print btn btn-info btn-sm', 'title' => 'Imprimir Guias de Pedido'], false, 'id');
    $dataGrid->alterWidth('valor_total_cobrado', 100, $dataGrid::TYPE_WIDTH_PX);
    $dataGrid->alterWidth('tempo_producao_aproximado_minutos', 200, $dataGrid::TYPE_WIDTH_PX);
    $dataGrid->display();
    ?>
</div>