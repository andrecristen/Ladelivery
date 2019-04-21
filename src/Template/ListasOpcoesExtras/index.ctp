<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListasOpcoesExtra[]|\Cake\Collection\CollectionInterface $listasOpcoesExtras
 */
?>
<div class="col-sm-12">
    <h3><?= __('Listas X Adicionais') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($listasOpcoesExtras);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_TEXT, true, true, 'auto', 'listasOpcoesExtras/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Lista', 'lista/nome_lista', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Opcional', 'opcoes_extra/nome_adicional', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'ativa', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
