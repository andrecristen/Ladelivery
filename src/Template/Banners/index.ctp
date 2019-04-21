<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Banner[]|\Cake\Collection\CollectionInterface $banners
 */
?>
<div class="col-sm-12">
    <h3><?= __('Banners') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->setModel($banners);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_banner', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('#Midia', 'midia/id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Midia', 'midia/nome_midia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'ativo', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
