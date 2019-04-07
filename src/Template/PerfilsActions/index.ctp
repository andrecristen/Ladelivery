<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PerfilsAction[]|\Cake\Collection\CollectionInterface $perfilsActions
 */
?>
<div class="col-sm-12">
    <h3><?= __('Perfils Actions') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($perfilsActions);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Action', 'action/descricao_action', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Perfil', 'perfil/nome_perfil', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->display();
    ?>
</div>
