<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TemposMedio[]|\Cake\Collection\CollectionInterface $temposMedios
 */
?>
<div class="col-sm-12">
    <h3><?= __('Tempos Produção') ?></h3>
    <?php
    $dataGrid = new \App\Model\Utils\DataGridLaDev();
    $listArredondamento = new \App\Model\Entity\TaxasEntregasCotacao();
    $dataGrid->setModel($temposMedios);
    $dataGrid->setPaginator($this->Paginator);
    $dataGrid->addField('#', 'id', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->addField('Nome', 'nome', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Empresa', 'empresa_id', \App\Model\Utils\DataGridLaDev::TYPE_TEXT);
    $dataGrid->addField('Tempo em minutos', 'tempo_medio_producao_minutos', \App\Model\Utils\DataGridLaDev::TYPE_NUMBER);
    $dataGrid->addField('Ativo', 'ativo', \App\Model\Utils\DataGridLaDev::TYPE_BOOLEAN);
    $dataGrid->display();
    ?>
</div>

