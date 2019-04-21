<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Controller[]|\Cake\Collection\CollectionInterface $controllers
 */
?>
<div class="col-sm-12">
    <h3><?= __('Controllers') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($controllers);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_controlador', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
