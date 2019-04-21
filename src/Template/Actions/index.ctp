<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Action[]|\Cake\Collection\CollectionInterface $actions
 */
?>
<div class="col-sm-12">
    <h3><?= __('Actions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <?php
        $dataGrid = new \App\Model\Utils\DataGridGenerator();
        $dataGrid->setModel($actions);
        $dataGrid->setPaginator($this->Paginator);
        $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
        $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_action', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
        $dataGrid->addField(new \App\Model\Utils\GridField('Descricao', 'descricao_action', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
        $dataGrid->addField(new \App\Model\Utils\GridField('#Controller', 'controller/id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
        $dataGrid->addField(new \App\Model\Utils\GridField('Nome Controller', 'controller/nome_controlador', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
        $dataGrid->setController($this->name);
        $dataGrid->display();
        ?>
</div>
