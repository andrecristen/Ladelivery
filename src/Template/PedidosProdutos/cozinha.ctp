<div class="col-sm-12">
    <h3><?= __('Produtos Cozinha') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    /** @var $pedidosProdutos \App\Model\Entity\PedidosProduto*/
    $dataGrid->setModel($pedidosProdutos);
    $dataGrid->bloqActionAdd();
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#Pedido', 'pedido_id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Tipo Pedido', 'pedido/tipo_pedido', \App\Model\Utils\DataGridUtils::TYPE_LIST , \App\Model\Entity\Pedido::getTipoList());
    $dataGrid->addField('Produto', 'produto/nome_produto', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Quantidade', 'quantidade', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Valor Cobrado', 'valor_total_cobrado', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('OBS.', 'observacao', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Status', 'status', \App\Model\Utils\DataGridUtils::TYPE_LIST, \App\Model\Entity\PedidosProduto::getStatusList());
    $dataGrid->addActionRow('', ['action' => 'alterarSituacao'], ['class' => 'fa fa-history btn btn-success btn-sm', 'title' => 'Alterar Situacao do Item'], false, 'id');
    $dataGrid->addActionRow('', ['controller' => 'Pedidos','action' => 'view'], ['class' => 'fa fa-search-plus btn btn-dark btn-sm', 'title' => 'Visualizar Pedido/Comanda'], false, 'pedido_id');
    $dataGrid->display();
    ?>
</div>
