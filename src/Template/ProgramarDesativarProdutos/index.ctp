<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProgramarDesativarProduto[]|\Cake\Collection\CollectionInterface $programarDesativarProdutos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Programar Desativar Produtos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($programarDesativarProdutos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Produto', 'produto/nome_produto', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('#Produto', 'produto/id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, false, true));
    $diaSemana = new \App\Model\Utils\GridField('Dia Semana', 'dia_semana', \App\Model\Utils\DataGridGenerator::TYPE_LIST );
    $diaSemana->setList(\App\Model\Entity\HorariosAtendimento::getDiaSemanaList());
    $dataGrid->addField($diaSemana);
    $dataGrid->addField(new \App\Model\Utils\GridField('Ativo', 'programacao_ativa', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN));
    $dataGrid->setController($this->name);
    $dataGrid->display();
    ?>
</div>