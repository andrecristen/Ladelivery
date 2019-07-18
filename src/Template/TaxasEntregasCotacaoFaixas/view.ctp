<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaxasEntregasCotacaoFaixa $taxasEntregasCotacaoFaixa
 */
?>
<div class="col-sm-12">
    <h3><?= h($taxasEntregasCotacaoFaixa->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($taxasEntregasCotacaoFaixa->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Empresa') ?></th>
            <td><?= $taxasEntregasCotacaoFaixa->has('empresa') ? $this->Html->link($taxasEntregasCotacaoFaixa->empresa->nome_fantasia, ['controller' => 'Empresas', 'action' => 'view', $taxasEntregasCotacaoFaixa->empresa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('KM Inicio') ?></th>
            <td><?= $this->Number->format($taxasEntregasCotacaoFaixa->kilometro_inicio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('KM Fim') ?></th>
            <td><?= $this->Number->format($taxasEntregasCotacaoFaixa->kilometro_fim) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= $taxasEntregasCotacaoFaixa->ativo ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
</div>
