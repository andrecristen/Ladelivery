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
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, '60px'));
    $dataGrid->addField(new \App\Model\Utils\GridField('R$ a Pagar', 'valor_a_pagar', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, false, '100px'));
    $dataGrid->addField(new \App\Model\Utils\GridField('R$ Total', 'valor_total', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, false, '100px'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Cliente', 'cliente', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    //$dataGrid->addField(new \App\Model\Utils\GridField('Valor Produtos', 'valor_produtos', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, '100px'));
    //$dataGrid->addField(new \App\Model\Utils\GridField('Tempo de Producao', 'tempo_producao_aproximado_minutos', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, '200px'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Data', 'data_pedido', \App\Model\Utils\DataGridGenerator::TYPE_DATE_TIME, true, true, '150px'));
    $status = new \App\Model\Utils\GridField('Status', 'status_pedido', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $status->setList($pedidoModel->getComandaStatusList());
    $dataGrid->addField($status);
    $dataGrid->addAction('Pedidos', 'add', 'Abrir Comanda', 'btn-primary', 'fas fa-sticky-note', 'true');
    $dataGrid->addActionRow('', ['action' => 'addItem'], ['class' => 'fas fa-plus-square btn btn-danger btn-sm', 'title' => 'Adicionar Item a Comanda'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'alterarSituacao'], ['class' => 'fa fa-history btn btn-success btn-sm', 'title' => 'Alterar Situacao da Comanda'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'imprimir'], ['class' => 'fa fa-print btn btn-info btn-sm', 'title' => 'Imprimir Guias de Pedido'], false, 'id');
    $dataGrid->addActionRow('', ['action' => 'gerenciarItens'], ['class' => 'fas fa-tasks btn btn-dark btn-sm', 'title' => 'Gerenciar Itens'], false, 'id');
    $dataGrid->setCallBackActionLimpar('comandas');
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>