<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OpcoesExtra[]|\Cake\Collection\CollectionInterface $opcoesExtras
 */
?>
<div class="col-sm-12">
    <h3><?= __('Adicionais') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($opcoesExtras);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true , 'auto', 'OpcoesExtras/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_adicional', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor', 'valor_adicional', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->display();
    ?>
</div>
