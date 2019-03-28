<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoogleMapsApiKey[]|\Cake\Collection\CollectionInterface $googleMapsApiKey
 */
?>
<div class="col-sm-12">
    <h3><?= __('Google Maps Api Keys') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setModel($googleMapsApiKey);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('KEY', 'api_key', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Ativo', 'ativa', \App\Model\Utils\DataGridUtils::TYPE_BOOLEAN);
    $dataGrid->display();
    ?>
</div>
