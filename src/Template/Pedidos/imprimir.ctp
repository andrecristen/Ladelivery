<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pedido $pedido
 */
$tableLocator = new \Cake\ORM\Locator\TableLocator();
/** @var $cliente \App\Model\Entity\User */
$cliente = $tableLocator->get('Users')->find()->where(['id' => $pedido->user_id])->first();
/** @var $entrega \App\Model\Entity\PedidosEntrega */
$entrega = $tableLocator->get('PedidosEntregas')->find()->where(['pedido_id' => $pedido->id])->first();
/** @var $enderecoEntrega \App\Model\Entity\Endereco */
$enderecoEntrega = $tableLocator->get('Enderecos')->find()->where(['id' => $entrega->endereco_id])->first();
?>
<div class="col-sm-12">
    <div class="alert alert-info">
        <strong>Atenção os itens listados nas guias de impressão são somente os que estão aguardando produção, para visualização de todos os itens que compõem o pedido ou a comanda utilize a ação de gerenciar itens.</strong>
    </div>
    <div style="padding: 10px" class="row">
        <div class="col-md-6">
            <table id="cozinhaPrint" class="printer-ticket">
                <thead>
                <tr>
                    <th class="title" colspan="3">Guia Produtos Cozinha Pedido #<?= $pedido->id ?></th>
                </tr>
                <tr>
                    <th colspan="3"><?= $pedido->data_pedido->format('d/m/Y - H:i:s') ?></th>
                </tr>
                <tr>
                    <th colspan="3">
                        Cliente : <?= $cliente->nome_completo ?><br/>
                    </th>
                </tr>
                <?php if ($pedido->cupom_usado) { ?>
                    <tr>
                        <th colspan="3">
                            Cupom : <?= $pedido->cupom_usado ?><br/>
                        </th>
                    </tr>
                <?php } ?>
                <tr>
                    <th class="ttu" colspan="3">
                        <b>Itens</b>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="top">
                    <td style="border-bottom: 1px solid black;" colspan="3"></td>
                </tr>
                <?php foreach ($itensCozinha as $key => $item) { ?>
                    <tr class="top">
                        <td colspan="3"><b>Item #<?= $item['id'] ?></b></td>
                    </tr>
                    <tr class="top">
                        <td colspan="3">Categoria: <?= $item['categoria'] ?></td>
                    </tr>
                    <tr class="top">
                        <td colspan="3">Produto: <?= $item['produto'] ?></td>
                    </tr>
                    <tr class="top">
                        <td colspan="3">Observacao: <?= $item['observacao'] ?></td>
                    </tr>
                    <tr>
                        <th class="ttu" colspan="3">Opcionais</th>
                    </tr>
                    <?php
                    if (count($adicionais[$key]) < 1) {
                        echo '<tr>
                                <td colspan="3">Nenhum Opcional</td>
                              </tr>';
                    } ?>
                    <?php foreach ($adicionais[$key] as $adicionaisItem) { ?>
                        <tr class="top">
                            <td colspan="3">Lista: <?= $adicionaisItem['lista'] ?>
                                <br/> Adicional: <?= $adicionaisItem['nomeAdicional'] ?>
                                <br/> Desc.: <?= $adicionaisItem['descricaoAdicional'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                    echo '<tr class="top">
                            <td style="border-bottom: 1px solid black;" colspan="3"></td>
                          </tr>';
                } ?>
                </tbody>
            </table>
            <button onclick="printTable('cozinhaPrint')" class="btn btn-info">Imprimir</button>
        </div>
        <div class="col-md-6">
            <table id="barPrint" class="printer-ticket">
                <thead>
                <tr>
                    <th class="title" colspan="3">Guia Produtos Bar Pedido #<?= $pedido->id ?></th>
                </tr>
                <tr>
                    <th colspan="3"><?= $pedido->data_pedido->format('d/m/Y - H:i:s') ?></th>
                </tr>
                <tr>
                    <th colspan="3">
                        Cliente : <?= $cliente->nome_completo ?><br/>
                    </th>
                </tr>
                <?php if ($pedido->cupom_usado) { ?>
                    <tr>
                        <th colspan="3">
                            Cupom : <?= $pedido->cupom_usado ?><br/>
                        </th>
                    </tr>
                <?php } ?>
                <tr>
                    <th class="ttu" colspan="3">
                        <b>Itens</b>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="top">
                    <td style="border-bottom: 1px solid black;" colspan="3"></td>
                </tr>
                <?php foreach ($itensBar as $key => $item) { ?>
                    <tr class="top">
                        <td colspan="3"><b>Item #<?= $item['id'] ?></b></td>
                    </tr>
                    <tr class="top">
                        <td colspan="3">Categoria: <?= $item['categoria'] ?></td>
                    </tr>
                    <tr class="top">
                        <td colspan="3">Produto: <?= $item['produto'] ?></td>
                    </tr>
                    <tr class="top">
                        <td colspan="3">Observacao: <?= $item['observacao'] ?></td>
                    </tr>
                    <tr>
                        <th class="ttu" colspan="3">Opcionais</th>
                    </tr>
                    <?php if (count($adicionais[$key]) < 1) {
                        echo '<tr>
                                <td colspan="3">Nenhum Opcional</td>
                              </tr>';
                    } ?>
                    <?php foreach ($adicionais[$key] as $adicionaisItem) { ?>
                        <tr class="top">
                            <td colspan="3">Lista: <?= $adicionaisItem['lista'] ?>
                                <br/> Adicional: <?= $adicionaisItem['nomeAdicional'] ?>
                                <br/> Desc.: <?= $adicionaisItem['descricaoAdicional'] ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php
                    echo '<tr class="top">
                            <td style="border-bottom: 1px solid black;" colspan="3"></td>
                          </tr>';
                } ?>
                </tbody>
            </table>
            <button onclick="printTable('barPrint')" class="btn btn-info">Imprimir</button>
        </div>
    </div>
</div>
<script>
    function printTable(selector) {
        var divToPrint = document.getElementById(selector);
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

</script>
<style>
    .ttu {
        text-transform: uppercase;
    }

    .printer-ticket {
        display: table !important;
        width: 100%;
        max-width: 400px;
        font-weight: light;
        line-height: 1.3em;
    @printer-padding-base: 10 px;

    &
    ,
    &
    * {
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
    }

    th:nth-child(2),
    td:nth-child(2) {
        width: 50px;
    }

    .linha {
        border-bottom: 1px solid black !important;
    }

    th:nth-child(3),
    td:nth-child(3) {
        width: 90px;
        text-align: right;
    }

    th {
        font-weight: inherit;
        padding: @printer-padding-base 0;
        text-align: center;
        border-bottom: 1px dashed @color-gray;
    }

    tbody {

    tr:last-child td {
        padding-bottom: @printer-padding-base;
    }

    }
    tfoot {

    .sup td {
        padding: @printer-padding-base 0;
        border-top: 1px dashed @color-gray;
    }

    .sup.p--0 td {
        padding-bottom: 0;
    }

    }

    .title {
        font-size: 1.5em;
        padding: @printer-padding-base *1.5 0;
    }

    .top {

    td {
        padding-top: @printer-padding-base;
    }

    }
    .last td {
        padding-bottom: @printer-padding-base;
    }

    }
</style>