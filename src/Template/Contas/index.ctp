<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conta[]|\Cake\Collection\CollectionInterface $contas
 */
?>
<div class="col-sm-12">
    <h3><?= __('Contas') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($contas);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $tipoList = new \App\Model\Utils\GridField('Tipo', 'tipo', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $tipoList->setList(\App\Model\Entity\Conta::getTipoList());
    $dataGrid->addField($tipoList);
    $dataGrid->addField(new \App\Model\Utils\GridField('Destinatário Cad.', 'user/nome_completo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Destinatário Não Cad.', 'pessoa', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor', 'valor_total', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Descricao', 'descricao', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Vencimento', 'data_vencimento', \App\Model\Utils\DataGridGenerator::TYPE_DATE));
    $dataGrid->addField(new \App\Model\Utils\GridField('Pagamento', 'data_pagamento', \App\Model\Utils\DataGridGenerator::TYPE_DATE));
    $dataGrid->setController($this->name);
    $dataGrid->addActionRow('', ['controller' => 'Contas','action' => 'definirPago'], ['class' => 'fas fa-wallet btn btn-dark btn-sm', 'title' => 'Definir como pago'], false, 'id');
    $dataGrid->display();
    ?>
</div>
