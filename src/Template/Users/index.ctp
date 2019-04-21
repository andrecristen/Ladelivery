<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="col-sm-12">
    <h3><?= __('Usúarios') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($users);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_completo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $fieldTipoUsers = new \App\Model\Utils\GridField('Tipo', 'tipo', \App\Model\Utils\DataGridGenerator::TYPE_LIST);
    $fieldTipoUsers->setList(\App\Model\Entity\User::getTipoListAll());
    $dataGrid->addField($fieldTipoUsers);
    $dataGrid->addField(new \App\Model\Utils\GridField('Apelido', 'apelido', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Login', 'login', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
