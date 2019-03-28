<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PedidosProduto $pedidosProduto
 */
?>
<div class="col-sm-12">
    <h3><?= h($pedidosProduto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Pedido') ?></th>
            <td><?= $pedidosProduto->has('pedido') ? $this->Html->link($pedidosProduto->pedido->id, ['controller' => 'Pedidos', 'action' => 'view', $pedidosProduto->pedido->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Produto') ?></th>
            <td><?= $pedidosProduto->has('produto') ? $this->Html->link($pedidosProduto->produto->nome_produto, ['controller' => 'Produtos', 'action' => 'view', $pedidosProduto->produto->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observacao') ?></th>
            <td><?= h($pedidosProduto->observacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adicionais') ?></th>
            <td>
                <?php
                $adicionaisCount = 0;
                $controller = new \App\Controller\PedidosController();
                $adicionais = $controller->getAdicionais($pedidosProduto);
                foreach ($adicionais as $index => $adicional){
                    $adicionaisCount = $adicionaisCount + 1;?>
                    <fieldset>
                        <legend></legend>
                        <div class="form-group">
                            <span>Lista: <?= $this->Html->link($adicional['lista'], ['controller' => 'Listas', 'action' => 'view', $adicional['lista_id']]) ?></span>
                        </div>
                        <div class="form-group">
                            <span>Adicional: <?= $this->Html->link($adicional['nomeAdicional'] , ['controller' => 'OpcoesExtras', 'action' => 'view', $adicional['adicional_id']]) ?></span>
                        </div>
                        <div class="form-group">
                            <span>Desc.: <?= $adicional['descricaoAdicional'] ?></span>
                        </div>
                        <legend></legend>
                    </fieldset>
                <?php }
                if($adicionaisCount < 1){
                    echo '<div class="alert alert-info" style="text-align: center">Este item não possui adicionais</div>';
                }
                ?>
            </td>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pedidosProduto->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantidade') ?></th>
            <td><?= $this->Number->format($pedidosProduto->quantidade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Total Cobrado') ?></th>
            <td><?= $this->Number->format($pedidosProduto->valor_total_cobrado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ambiente Producao Responsavel') ?></th>
            <td><?= $this->Number->format($pedidosProduto->ambiente_producao_responsavel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($pedidosProduto->status) ?></td>
        </tr>
    </table>
</div>
