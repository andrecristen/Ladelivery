<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CupomSite[]|\Cake\Collection\CollectionInterface $cupomSite
 */
?>
<div class="col-sm-12">
    <h3><?= __('Cupom Site') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridGenerator();
    $dataGrid->setModel($cupomSite);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField(new \App\Model\Utils\GridField('#', 'id', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER, true , false, 'auto'));
    $dataGrid->addField(new \App\Model\Utils\GridField('Empresa', 'empresa/nome_fantasia', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Nome', 'nome_cupom', \App\Model\Utils\DataGridGenerator::TYPE_TEXT));
    $dataGrid->addField(new \App\Model\Utils\GridField('Vezes Usado', 'vezes_usado', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Usos Maximos', 'maximo_vezes_usar', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Valor Desconto', 'valor_desconto', \App\Model\Utils\DataGridGenerator::TYPE_NUMBER));
    $dataGrid->addField(new \App\Model\Utils\GridField('Porcentagem', 'porcentagem', \App\Model\Utils\DataGridGenerator::TYPE_BOOLEAN, true, false));
    $dataGrid->display();
    ?>
</div>
