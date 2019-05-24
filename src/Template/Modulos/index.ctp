<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Modulo[]|\Cake\Collection\CollectionInterface $modulos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Modulos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->setModel($modulos);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Icone', 'icon_class', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Ordem', 'ordem', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'ativo', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
