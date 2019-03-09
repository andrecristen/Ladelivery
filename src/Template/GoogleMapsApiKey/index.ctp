<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoogleMapsApiKey[]|\Cake\Collection\CollectionInterface $googleMapsApiKey
 */
?>
<div class="col-sm-12">
    <h3><?= __('Google Maps Api Keys') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($googleMapsApiKey);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Usuário', 'user/nome_completo', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('KEY', 'api_key', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Ativo', 'ativa', \App\Model\Utils\DataGridLaDev::TYPE_BOOLEAN);
    $dataGrid->display();
    ?>
</div>
