<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListasOpcoesExtra[]|\Cake\Collection\CollectionInterface $listasOpcoesExtras
 */
?>
<div class="col-sm-12">
    <h3><?= __('Listas X Adicionais') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($listasOpcoesExtras);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Lista', 'lista/nome_lista', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Opcional', 'opcoes_extra/nome_adicional', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Ativo', 'ativa', \App\Model\Utils\DataGridLaDev::TYPE_BOOLEAN);
    $dataGrid->display();
    ?>
</div>
