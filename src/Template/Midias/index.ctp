<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Midia[]|\Cake\Collection\CollectionInterface $midias
 */
?>
<div class="col-sm-12">
    <h3><?= __('Midias') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($midias);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true, 'auto', 'midias/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $tipo = new \App\Model\Utils\GridField('Tipo', 'tipo_midia', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $tipo->setList(\App\Model\Entity\Midia::getTipoList());
    $dataGrid->addField($tipo);
    $empresaUtils = new \App\Model\Utils\EmpresaUtils();
    if($empresaUtils->isEmpresaSoftware()){
        $dataGrid->addField(new \App\Model\Utils\GridField('Path', 'path_midia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    }
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_midia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->display()
    ?>
</div>
