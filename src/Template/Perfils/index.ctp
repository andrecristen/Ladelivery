<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Perfil[]|\Cake\Collection\CollectionInterface $perfils
 */
?>
<div class="col-sm-12">
    <h3><?= __('Perfils') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($perfils);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addAction('PerfilsActions', 'index', 'Perfil x Action','btn-success', 'fas fa-charging-station');
    $dataGrid->addAction('PerfilsUsers', 'index', 'Perfil x User','btn-info', 'fas fa-address-card');
    $dataGrid->addField(new \App\Model\Utils\GridField('#','id',\App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome','nome_perfil',\App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Adiciona a novos Users','padrao_novos_users',\App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
