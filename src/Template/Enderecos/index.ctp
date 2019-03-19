<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Endereco[]|\Cake\Collection\CollectionInterface $enderecos
 */
?>
<div class="col-sm-12">
    <h3><?= __('Enderecos') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setModel($enderecos);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Usuário', 'user/nome_completo', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Tipo', 'tipo_endereco', \App\Model\Utils\DataGridUtils::TYPE_LIST, [1=> 'Cliente', 2=> 'Empresa']);
    $dataGrid->addField('Rua', 'rua', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Número', 'numero', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Bairro', 'bairro', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Cidade', 'cidade', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Cep', 'cep', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Complemento', 'complemento', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Estado', 'estado', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->display();
    ?>
</div>
