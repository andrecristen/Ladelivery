<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lista[]|\Cake\Collection\CollectionInterface $listas
 */
?>
<div class="col-sm-12">
    <h3><?= __('Listas') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($listas);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true, true , 'auto', 'listas/id'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_lista', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Titulo', 'titulo_lista', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Máximo selecionar', 'max_opcoes_selecionadas_lista', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Minimo selecionar', 'min_opcoes_selecionadas_lista', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->bloqActionDelete();
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>
