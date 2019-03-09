<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OpcoesExtra[]|\Cake\Collection\CollectionInterface $opcoesExtras
 */
?>
<div class="col-sm-12">
    <h3><?= __('Adicionais') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($opcoesExtras);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Nome', 'nome_adicional', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Valor', 'valor_adicional', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->display();
    ?>
</div>
