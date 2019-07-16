<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaxasEntregasCotacao $taxasEntregasCotacao
 */
?>
<div class="col-sm-12">
    <h3>Taxa Cotação #<?= h($taxasEntregasCotacao->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($taxasEntregasCotacao->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Km') ?></th>
            <td><?= $this->Number->format($taxasEntregasCotacao->valor_km) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Arredondamento Tipo') ?></th>
            <td><?= $this->Number->format($taxasEntregasCotacao->arredondamento_tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Base Erro') ?></th>
            <td><?= $this->Number->format($taxasEntregasCotacao->valor_base_erro) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= $taxasEntregasCotacao->ativo ? __('Sim') : __('Nao'); ?></td>
        </tr>
    </table>
</div>
