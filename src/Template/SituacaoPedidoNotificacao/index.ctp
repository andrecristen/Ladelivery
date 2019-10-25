<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SituacaoPedidoNotificacao[]|\Cake\Collection\CollectionInterface $situacaoPedidoNotificacao
 */
?>
<div class="col-sm-12">
    <h3><?= __('Notificação Pedido ') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($situacaoPedidoNotificacao);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Título', 'template_titulo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Mensagem', 'template_mensagem', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $situacao = new \App\Model\Utils\GridField('Situação', 'situacao_pedido', \App\Model\Utils\DataGridGenerator::TYPE_LIST );
    $situacao->setList(\App\Model\Entity\Pedido::getDeliveryStatusList());
    $dataGrid->addField($situacao);
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
