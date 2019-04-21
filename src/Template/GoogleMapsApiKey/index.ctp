<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoogleMapsApiKey[]|\Cake\Collection\CollectionInterface $googleMapsApiKey
 */
?>
<div class="col-sm-12">
    <h3><?= __('Google Maps Api Keys') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($googleMapsApiKey);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_TEXT, false, false));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('KEY', 'api_key', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'ativa', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
