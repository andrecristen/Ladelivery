<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CupomSite[]|\Cake\Collection\CollectionInterface $cupomSite
 */
?>
<div class="col-sm-12">
    <h3><?= __('Cupom Site') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridUtils();
    $dataGrid->setModel($cupomSite);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Nome', 'nome_cupom', \App\Model\Utils\DataGridUtils::TYPE_TEXT);
    $dataGrid->addField('Vezes Usado', 'vezes_usado', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Usos Maximos', 'maximo_vezes_usar', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Valor Desconto', 'valor_desconto', \App\Model\Utils\DataGridUtils::TYPE_NUMBER);
    $dataGrid->addField('Porcentagem', 'porcentagem', \App\Model\Utils\DataGridUtils::TYPE_BOOLEAN);
    $dataGrid->display();
    ?>
</div>
