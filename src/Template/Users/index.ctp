<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="col-sm-12">
    <h3><?= __('Usúarios') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setModel($users);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Nome', 'nome_completo', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Tipo', 'tipo', \App\Model\Utils\DataGridUtils::TYPE_LIST, [1=> 'Cliente', 2=> 'Administrador', 3 => 'Empresa']);
    $dataGrid->addField('Apelido', 'apelido', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Login', 'login', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->display();
    ?>
</div>
