<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pedido $pedido
 */
$tableLocator = new \Cake\ORM\Locator\TableLocator();
/** @var $entrega \App\Model\Entity\PedidosEntrega */
$entrega = $tableLocator->get('PedidosEntregas')->find()->where(['pedido_id' => $pedido->id])->first();
/** @var $endereco \App\Model\Entity\Endereco */
$endereco = $tableLocator->get('Enderecos')->find()->where(['id' => $entrega->endereco_id])->first();
$listUtils = new \App\Model\Utils\ListUtils();
$itens = $tableLocator->get('PedidosProdutos')->find()->where(['pedido_id' => $pedido->id])->contain(['Produtos' => 'CategoriasProdutos']);
?>
<div class="col-sm-12">
    <?php
    if ($pedido->tipo_pedido == \App\Model\Entity\Pedido::TIPO_PEDIDO_DELIVERY) {
        echo '<h3>Pedido #' . h($pedido->id) . '</h3>';
        $status = $listUtils->returnListPosition($pedido->status_pedido, \App\Model\Entity\Pedido::getDeliveryStatusList());
        $createEntregaTable = true;
    } else {
        echo '<h3>Comanda #' . h($pedido->id) . '</h3>';
        $status = $listUtils->returnListPosition($pedido->status_pedido, \App\Model\Entity\Pedido::getComandaStatusList());
        $createEntregaTable = false;
    }
    ?>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pedido->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Situação') ?></th>
            <td><?= h($status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Total Cobrado') ?></th>
            <td><?= $this->Number->format($pedido->valor_total_cobrado) ?></td>
        </tr>
    </table>
    <?php
    if ($createEntregaTable) {
        ?>
        <h3>Entrega</h3>
        <table class="vertical-table">
            <tr>
                <th scope="row"><?= __('Valor Entrega') ?></th>
                <td><?= h($entrega->valor_entrega) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Rua') ?></th>
                <td><?= h($endereco->rua) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Bairro') ?></th>
                <td><?= h($endereco->bairro) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Cidade') ?></th>
                <td><?= h($endereco->cidade) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Complemento') ?></th>
                <td><?= h($endereco->complemento) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Estado') ?></th>
                <td><?= h($endereco->estado) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('CEP') ?></th>
                <td><?= h($endereco->cep) ?></td>
            </tr>
        </table>
    <?php } ?>

    <h3>Itens</h3>

    <?php
    /** @var $item \App\Model\Entity\PedidosProduto */
    $listaStatus = \App\Model\Entity\PedidosProduto::getStatusList();
    $listaAmbiente = \App\Model\Entity\PedidosProduto::getAmbienteResponsavel();
    foreach ($itens as $item) { ?>
        <table class="vertical-table">
            <tr>
                <th scope="row"><?= __('Produto') ?></th>
                <td><?= h($item->produto->nome_produto) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Categoria') ?></th>
                <td><?= h($item->produto->categorias_produto->nome_categoria) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Quantidade') ?></th>
                <td><?= h($item->quantidade) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Preco') ?></th>
                <td><?= h($item->valor_total_cobrado) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Status') ?></th>
                <td><?= h($listaStatus[$item->status]) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Observacao') ?></th>
                <td><?= h($item->observacao) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Observacao') ?></th>
                <td><?= h($listaAmbiente[$item->ambiente_producao_responsavel]) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Adicionais') ?></th>
                <td>
                    <?php
                    $adicionaisCount = 0;
                    $controller = new \App\Controller\PedidosController();
                    $adicionais = $controller->getAdicionais($item);
                    foreach ($adicionais as $index => $adicional){
                        $adicionaisCount = $adicionaisCount + 1;?>
                        <fieldset>
                            <legend></legend>
                            <div class="form-group">
                                <span>Lista: <?= $adicional['lista'] ?></span>
                            </div>
                            <div class="form-group">
                                <span>Adicional: <?= $adicional['nomeAdicional'] ?></span>
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
            </tr>
        </table>
    <?php } ?>
</div>