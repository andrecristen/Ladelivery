<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListasOpcoesExtra $listasOpcoesExtra
 */
?>
<div class="col-sm-12">
    <h3>Visualizar Relacionamento Lista: <?= h($listasOpcoesExtra->lista->nome_lista) ?> e Adicional: <?= h($listasOpcoesExtra->opcoes_extra->nome_adicional) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($listasOpcoesExtra->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lista') ?></th>
            <td><?= $listasOpcoesExtra->has('lista') ? $this->Html->link($listasOpcoesExtra->lista->id, ['controller' => 'Listas', 'action' => 'view', $listasOpcoesExtra->lista->nome_lista]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adicional') ?></th>
            <td><?= $listasOpcoesExtra->has('opcoes_extra') ? $this->Html->link($listasOpcoesExtra->opcoes_extra->id, ['controller' => 'OpcoesExtras', 'action' => 'view', $listasOpcoesExtra->opcoes_extra->nome_adicional]) : '' ?></td>
        </tr>
    </table>
</div>
