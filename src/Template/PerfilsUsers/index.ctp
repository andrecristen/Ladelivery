<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PerfilsUser[]|\Cake\Collection\CollectionInterface $perfilsUsers
 */
?>
<div class="col-sm-12">
    <h3><?= __('Perfils Users') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($perfilsUsers);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Perfil', 'perfil/nome_perfil', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('User', 'user/nome_completo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
