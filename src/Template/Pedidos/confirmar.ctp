<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pedido $pedido
 */
$tableLocator = new \Cake\ORM\Locator\TableLocator();
?>
<div class="col-sm-12">
    <?= $this->Form->create($pedido);
    /** @var $cliente \App\Model\Entity\User*/
    $cliente = $tableLocator->get('Users')->find()->where(['id'=> $pedido->user_id])->first();
    /** @var $entrega \App\Model\Entity\PedidosEntrega*/
    $entrega = $tableLocator->get('PedidosEntregas')->find()->where(['pedido_id'=> $pedido->id])->first();
    /** @var $enderecoEntrega \App\Model\Entity\Endereco*/
    $enderecoEntrega = $tableLocator->get('Enderecos')->find()->where(['id'=> $entrega->endereco_id])->first()?>
    <fieldset class="pedido">
        <legend>Pedido #<?= $pedido->id ?> - Listagem dos dados gerais do pedido</legend>
        <div class="form-horizontal">
            <div class="form-group">
                <span>Cliente: <?= $cliente->nome_completo ?></span>
            </div>
            <div class="form-group">
                <span>Valor Produtos: R$<?= $pedido->valor_produtos ?></span>
            </div>
            <div class="form-group">
                <span>Valor Acrescimo: R$<?= $pedido->valor_acrescimo ?></span>
            </div>
            <div class="form-group">
                <span>Valor Desconto: R$<?= $pedido->valor_desconto ?></span>
            </div>
            <?php if($entrega){?>
                <div class="form-group">
                    <span>Valor Entrega: R$<?= $entrega->valor_entrega ?></span>
                </div>
            <?php }else{ ?>
                <div class="form-group">
                    <span>Valor Entrega: Entrega não contratada</span>
                </div>
            <?php }?>
            <div class="form-group">
                <b>Valor Total: R$<?= $pedido->getValorTotal() ?></b>
            </div>
        </div>
    </fieldset>
    <fieldset class="entrega">
        <legend>Entrega - Listagem dos dados de entrega do pedido</legend>
        <?php if($entrega){?>
            <div class="form-horizontal">
                <div class="form-group">
                    <span>Valor Entrega: R$<?= $entrega->valor_entrega?></span>
                </div>
                <div class="form-group">
                    <span>Rua: <?= $enderecoEntrega->rua ?></span>
                </div>
                <div class="form-group">
                    <span>Bairro: <?= $enderecoEntrega->bairro ?></span>
                </div>
                <div class="form-group">
                    <span>Numero: <?= $enderecoEntrega->numero ?></span>
                </div>
                <div class="form-group">
                    <span>Cidade: <?= $enderecoEntrega->cidade ?></span>
                </div>
                <div class="form-group">
                    <span>Estado: <?= $enderecoEntrega->estado ?></span>
                </div>
                <div class="form-group">
                    <span>Complemento: <?= $enderecoEntrega->complemento ?></span>
                </div>
            </div>
       <?php }else{ ?>
            <div class="form-horizontal">
                <div class="form-group">
                    <span>O cliente irá retirar o pedido no seu estabelecimento</span>
                </div>
            </div>
        <?php }?>
    </fieldset>
    <fieldset>
        <legend>Itens Do Pedido - Listagem de todos os itens que compoem o pedido</legend>
        <?php
        /** @var $pedidoItem \App\Model\Entity\PedidosProduto*/
        foreach ($produtosFinal as $pedidoItem) {
            /** @var $produto \App\Model\Entity\Produto*/
            $produto = $tableLocator->get('Produtos')->find()->where(['id'=>$pedidoItem->produto_id])->first();
            /** @var $categoria \App\Model\Entity\CategoriasProduto*/
            $categoria = $tableLocator->get('CategoriasProdutos')->find()->where(['id'=>$produto->categorias_produto_id])->first();
            ?>
            <fieldset>
                <legend></legend>
                <div class="form-horizontal">
                    <div class="form-group">
                        <h2>Item #: <?= $pedidoItem->id ?></h2>
                    </div>
                    <div class="form-group">
                        <span>Produto: <?= $produto->nome_produto ?></span>
                    </div>
                    <div class="form-group">
                        <span>Descrição: <?= $produto->descricao_produto ?></span>
                    </div>
                    <div class="form-group">
                        <span>Categoria: <?= $categoria->nome_categoria ?></span>
                    </div>
                    <div class="form-group">
                        <fieldset>
                            <legend>Adicionais</legend>
                            <?php
                            $adicionaisCount = 0;
                            foreach ($adicionais[$pedidoItem->id] as $tituloLista => $lista){
                                $adicionaisCount = $adicionaisCount + 1;?>
                                <div class="alert alert-info">
                                    <div class="form-group">
                                        <b>Lista : <?= $tituloLista ?></b>
                                    </div>
                                    <?php foreach ($lista as $adicional){ ?>
                                        <fieldset>
                                            <legend></legend>
                                            <div class="form-group">
                                                <span>Nome: <?= $adicional['nome'] ?></span>
                                            </div>
                                            <div class="form-group">
                                                <span>Descricao: <?= $adicional['descricao'] ?></span>
                                            </div>
                                        </fieldset>
                                    <?php }?>
                                </div>
                            <?php }
                            if($adicionaisCount < 1){
                                echo '<div class="alert alert-info" style="text-align: center">Este item não possui adicionais</div>';
                            }
                            ?>

                            <legend></legend>
                        </fieldset>
                    </div>
                    <div class="form-group">
                        <span>Quantidade: <?= $pedidoItem-> quantidade ?></span>
                    </div>
                    <div class="form-group">
                        <span>Valor Cobrado: <?= $pedidoItem->valor_total_cobrado ?></span>
                    </div>
                    <div class="form-group">
                        <span>Observação: <?= $pedidoItem->observacao ?></span>
                    </div>
                </div>
                <br/>
            </fieldset>
        <?php
        }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Confirmar')) ?>
    <?= $this->Html->link(__('Rejeitar'), ['controller' => 'Pedidos', 'action' => 'rejeitar/'.$pedido->id], ['class'=>'button btn-danger']) ?>
    <br/>
    <br/>
    <?= $this->Form->end() ?>
    <script>
        $().button('toggle');
    </script>
    <style>
        .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active{
            background-color: rgb(14, 171, 98)!important;
        }
        .form-horizontal{
            padding-left: 5px;
        }
        span{
            font-size: 16px;
        }
        .pedido{
            background-color: #47b8e217;
        }
        .entrega{
            background-color: #3a945b21;
        }
    </style>
</div>