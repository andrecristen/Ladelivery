<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa[]|\Cake\Collection\CollectionInterface $empresas
 */
?>
<div class="col-sm-12">
    <h3><?= __('Empresas') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $dataGrid->setModel($empresas);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Nome', 'nome_fantasia', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Usuario', 'user/nome_completo', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('CNPJ', 'cnpj', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Inscrição Estadual', 'ie', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Ativo', 'ativa', \App\Model\Utils\DataGridLaDev::TYPE_BOOLEAN);
    $dataGrid->display();
    ?>
</div>