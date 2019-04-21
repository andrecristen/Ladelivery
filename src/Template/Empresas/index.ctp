<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa[]|\Cake\Collection\CollectionInterface $empresas
 */
?>
<div class="col-sm-12">
    <h3><?= __('Empresas') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($empresas);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $tipoEmpresa = new \App\Model\Utils\GridField('Tipo', 'tipo_empresa', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $tipoEmpresa->setList(\App\Model\Entity\Empresa::getTipoList());
    $dataGrid->addField($tipoEmpresa);
    $dataGrid->addField(new \App\Model\Utils\GridField('CNPJ', 'cnpj', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Inscrição Estadual', 'ie', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'ativa', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->addAction('EnderecosEmpresas', 'index', 'Endereços Empresa', 'btn btn-success', 'fas fa-map-marked-alt');
    $dataGrid->display();
    ?>
</div>
