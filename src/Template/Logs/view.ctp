<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log $log
 */
?>
<div class="col-sm-12">
    <h3><?= h($log->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $log->has('user') ? $this->Html->link($log->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $log->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($log->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= $this->Number->format($log->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Situacao') ?></th>
            <td><?= $this->Number->format($log->situacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Data Hora') ?></th>
            <td><?= h($log->data_hora) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descricao') ?></h4>
        <?= $this->Text->autoParagraph(h($log->descricao)); ?>
    </div>
</div>
