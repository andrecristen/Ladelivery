<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Endereco[]|\Cake\Collection\CollectionInterface $enderecos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Enderecos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($enderecos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'endereco/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Usuário/Cliente', 'user/nome_completo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Rua', 'rua', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Número', 'numero', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Bairro', 'bairro', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Cidade', 'cidade', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Cep', 'cep', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Complemento', 'complemento', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $estado = new \App\Model\Utils\GridField('Estado', 'estado', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $estado->setList(\App\Model\Entity\Endereco::getEstados());
    $dataGrid->addField($estado);
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
