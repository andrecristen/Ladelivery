<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lista[]|\Cake\Collection\CollectionInterface $listas
 */
?>
<div class="col-sm-12">
    <h3><?= __('Listas') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($listas);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Nome', 'nome_lista', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Titulo', 'titulo_lista', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Máximo selecionar', 'max_opcoes_selecionadas_lista', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->addField('Minimo selecionar', 'min_opcoes_selecionadas_lista', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->display();
    ?>
</div>
