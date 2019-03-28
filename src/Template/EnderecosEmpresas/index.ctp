<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnderecosEmpresa[]|\Cake\Collection\CollectionInterface $enderecosEmpresas
 */
?>
<div class="col-sm-12">
    <h3><?= __('Enderecos Empresas') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($enderecosEmpresas);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Rua', 'rua', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Número', 'numero', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Bairro', 'bairro', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Cidade', 'cidade', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $estado = new \App\Model\Utils\GridField('Estado', 'estado', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $estado->setList(\App\Model\Entity\Endereco::getEstados());
    $dataGrid->addField($estado);
    $dataGrid->addField(new \App\Model\Utils\GridField('Cep', 'cep', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->display();
    ?>
</div>
