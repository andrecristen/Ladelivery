<div class="col-sm-12">
    <h3><?= __('Produtos Bar') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($pedidosProdutos);
    $dataGrid->bloqActionAdd();
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('Pedido', 'pedido/id', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $tipoPedido = new \App\Model\Utils\GridField('Tipo Pedido', 'pedido/tipo_pedido', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $tipoPedido->setList(\App\Model\Entity\Pedido::getTipoList());
    $dataGrid->addField($tipoPedido);
    $dataGrid->addField(new \App\Model\Utils\GridField('Produto', 'produto/nome_produto', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Quantidade', 'quantidade', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor Cobrado', 'valor_total_cobrado', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'pedidosProduto/valor_total_cobrado'));
    $dataGrid->addField(new \App\Model\Utils\GridField('OBS.', 'observacao', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $status = new \App\Model\Utils\GridField('Status', 'status', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $status->setList(\App\Model\Entity\PedidosProduto::getStatusGridList());
    $dataGrid->addField($status);
    $dataGrid->addActionRow('', ['action' => 'alterarSituacao'], ['class' => 'fa fa-history btn btn-success btn-sm', 'title' => 'Alterar Situacao do Item'], false, 'id');
    $dataGrid->addActionRow('', ['controller' => 'Pedidos','action' => 'view'], ['class' => 'fa fa-search-plus btn btn-dark btn-sm', 'title' => 'Visualizar Pedido/Comanda'], false, 'pedido_id');
    $dataGrid->setCallBackActionLimpar('bar');
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>