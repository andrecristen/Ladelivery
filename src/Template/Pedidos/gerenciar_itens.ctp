<?php
$listUtils = new \App\Model\Utils\ListUtils();
?>
<div class="col-sm-12">
    <?php
    if ($pedido->tipo_pedido == \App\Model\Entity\Pedido::TIPO_PEDIDO_DELIVERY) {
        echo '<h3>Pedido #' . h($pedido->id) . '</h3>';
        $status = $listUtils->returnListPosition($pedido->status_pedido, \App\Model\Entity\Pedido::getDeliveryStatusList());
    } else {
        echo '<h3>Comanda #' . h($pedido->id) . '</h3>';
        $status = $listUtils->returnListPosition($pedido->status_pedido, \App\Model\Entity\Pedido::getComandaStatusList());
    }
    ?>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Html->link($pedido->id, ['controller' => 'Pedidos', 'action' => 'view', $pedido->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cliente') ?></th>
            <?php if ($pedido->tipo_pedido == \App\Model\Entity\Pedido::TIPO_PEDIDO_DELIVERY) { ?>
                <td><?= $pedido->has('user') ? $this->Html->link($pedido->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $pedido->user->id]) : '' ?></td>
            <?php } else { ?>
                <td><?= h($pedido->cliente) ?></td>
            <?php } ?>
        </tr>
        <tr>
            <th scope="row"><?= __('Situação') ?></th>
            <td><?= h($status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Total R$') ?></th>
            <td><?= $this->Number->format($pedido->getValorTotal()) ?></td>
        </tr>
        <?php if ($pedido->tipo_pedido == \App\Model\Entity\Pedido::TIPO_PEDIDO_COMANDA) { ?>
        <tr>
            <th scope="row"><?= __('Valor Total Pendente R$') ?></th>
            <td><?= $this->Number->format($pedido->valor_a_pagar) ?></td>
        </tr>
        <?php } ?>
    </table>
    <h3><?= __('Itens Cozinha') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($itensCozinha);
    $dataGrid->bloqActionAdd();
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->bloqActionView();
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Produto', 'produto', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Categoria', 'categoria', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Total R$', 'valorTotal', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Status', 'status', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->setShowFilters(false);
    $dataGrid->addActionRow('', ['controller' => 'PedidosProdutos', 'action' => 'alterarSituacao'], ['class' => 'fa fa-history btn btn-success btn-sm', 'title' => 'Alterar Situacao do Item'], false, 'id', true);
    $dataGrid->addActionRow('', ['controller' => 'PedidosProdutos', 'action' => 'view'], ['class' => 'fa fa-search btn btn-info btn-sm', 'title' => 'Visualizar'], false, 'id');
    $dataGrid->display();
    ?>
    <h3><?= __('Itens Bar') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($itensBar);
    $dataGrid->bloqActionAdd();
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->bloqActionView();
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Produto', 'produto', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Categoria', 'categoria', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Total R$', 'valorTotal', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Status', 'status', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->setShowFilters(false);
    $dataGrid->addActionRow('', ['controller' => 'PedidosProdutos', 'action' => 'alterarSituacao'], ['class' => 'fa fa-history btn btn-success btn-sm', 'title' => 'Alterar Situacao do Item'], false, 'id', true);
    $dataGrid->addActionRow('', ['controller' => 'PedidosProdutos', 'action' => 'view'], ['class' => 'fa fa-search btn btn-info btn-sm', 'title' => 'Visualizar'], false, 'id');
    $dataGrid->display();
    ?>
</div>
