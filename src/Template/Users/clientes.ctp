<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="col-sm-12">
    <h3><?= __('Clientes') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($users);
    $dataGrid->bloqActionDelete();
    $dataGrid->bloqActionEdit();
    $dataGrid->bloqActionAdd();
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_completo', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Apelido', 'apelido', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Login', 'login', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->addActionRow('', ['controller' => 'Marketing', 'action' => 'email'], ['class' => 'fas fa-envelope-open-text btn btn-success btn-sm', 'title' => 'Enviar Email'], false, 'id');
    $dataGrid->setCallBackActionLimpar('clientes');
    $dataGrid->display();
    ?>
</div>
