<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SituacaoPedidoNotificacao $situacaoPedidoNotificacao
 */
?>
<div class="col-sm-12">
    <div class="alert alert-success">
        <b>Informações Disponiveis:</b>
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::LINK_SITE?>:</b> Link do site
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::NOME_LOJA?>:</b> Nome da loja
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::NOME_SITEMA?>:</b> Nome sistema
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::PEDIDO_ID?>:</b> Identificador do Pedido
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::PEDIDO_STATUS?>:</b> Situação do Pedido
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::PEDIDO_VALOR?>:</b> Valor total do Pedido
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::PEDIDO_ACRESCIMO?>:</b> Valor acrescimo do Pedido
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::PEDIDO_DESCONTO?>:</b> Valor desconto do Pedido
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::FORMA_PAGAMENTO?>:</b> Forma de pagamento do Pedido
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::TEMPO_PRODUCAO?>:</b> Tempo de produção estimado do Pedido
        <br/>
        <b><?= \App\Model\Entity\SituacaoPedidoNotificacao::USER_NAME?>:</b> Nome do cliente do Pedido
    </div>
    <?= $this->Form->create($situacaoPedidoNotificacao) ?>
    <?= $this->Form->create($situacaoPedidoNotificacao) ?>
    <fieldset>
        <legend><?= __('Editar Situação Pedido x Notificação') ?></legend>
        <?php
        echo $this->Form->control('situacao_pedido', ['options' => \App\Model\Entity\Pedido::getDeliveryAlterStatusList()]);
        echo $this->Form->control('template_titulo');
        echo $this->Form->control('template_mensagem');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
