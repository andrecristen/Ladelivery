<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FormasPagamento[]|\Cake\Collection\CollectionInterface $formasPagamentos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Formas Pagamentos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setModel($formasPagamentos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Nome', 'nome', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Maquina Cartao', 'necesista_maquina_cartao', \App\Model\Utils\DataGridUtils::TYPE_BOOLEAN);
    $dataGrid->addField('Troco', 'necessita_troco', \App\Model\Utils\DataGridUtils::TYPE_BOOLEAN);
    $dataGrid->addField('Porcentagem Juros', 'aumenta_valor', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->display();
    ?>
</div>
