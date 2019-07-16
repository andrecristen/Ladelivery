<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Action $action
 */
?>
<div class="col-sm-12">
    <h3>Action #<?= h($action->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($action->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Controller') ?></th>
            <td><?= $action->has('controller') ? $this->Html->link($action->controller->nome_controlador, ['controller' => 'Controllers', 'action' => 'view', $action->controller->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Action') ?></th>
            <td><?= h($action->nome_action) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descrição') ?></th>
            <td><?= h($action->descricao_action) ?></td>
        </tr>
    </table>
</div>
