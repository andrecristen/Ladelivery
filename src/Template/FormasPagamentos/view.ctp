<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FormasPagamento $formasPagamento
 */
?>
<div class="col-sm-12">
    <h3><?= h($formasPagamento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Empresa') ?></th>
            <td><?= $formasPagamento->has('empresa') ? $this->Html->link($formasPagamento->empresa->nome_fantasia, ['controller' => 'Empresas', 'action' => 'view', $formasPagamento->empresa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($formasPagamento->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($formasPagamento->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Necesista Maquina Cartao') ?></th>
            <td><?= $formasPagamento->necesista_maquina_cartao ? __('Sim') : __('Nao'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Necessita Troco') ?></th>
            <td><?= $formasPagamento->necessita_troco ? __('Sim') : __('Nao'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Aumenta Valor %') ?></th>
            <td><?= $this->Number->format($formasPagamento->aumenta_valor) ?></td>
        </tr>
    </table>
</div>
