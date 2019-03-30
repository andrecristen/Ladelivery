<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FormasPagamento[]|\Cake\Collection\CollectionInterface $formasPagamentos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Formas Pagamentos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($formasPagamentos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'FormasPagamentos/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Maquina Cartao', 'necesista_maquina_cartao', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->addField(new \App\Model\Utils\GridField('Troco', 'necessita_troco', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->addField(new \App\Model\Utils\GridField('Porcentagem Juros', 'aumenta_valor', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->display();
    ?>
</div>
