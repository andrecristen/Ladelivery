<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CupomSite $cupomSite
 */
?>
<div class="col-sm-12">
    <h3>Cupom #<?= h($cupomSite->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($cupomSite->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Cupom') ?></th>
            <td><?= h($cupomSite->nome_cupom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vezes Usado') ?></th>
            <td><?= $this->Number->format($cupomSite->vezes_usado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maximo Vezes Usar') ?></th>
            <td><?= $this->Number->format($cupomSite->maximo_vezes_usar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor Desconto') ?></th>
            <td><?= $this->Number->format($cupomSite->valor_desconto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Porcentagem') ?></th>
            <td><?= $cupomSite->porcentagem ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
