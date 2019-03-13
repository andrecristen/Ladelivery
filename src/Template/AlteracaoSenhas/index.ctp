<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AlteracaoSenha[]|\Cake\Collection\CollectionInterface $alteracaoSenhas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Alteracao Senha'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="alteracaoSenhas index large-9 medium-8 columns content">
    <h3><?= __('Alteracao Senhas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('token') ?></th>
                <th scope="col"><?= $this->Paginator->sort('validade') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alteracaoSenhas as $alteracaoSenha): ?>
            <tr>
                <td><?= $this->Number->format($alteracaoSenha->id) ?></td>
                <td><?= $alteracaoSenha->has('user') ? $this->Html->link($alteracaoSenha->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $alteracaoSenha->user->id]) : '' ?></td>
                <td><?= h($alteracaoSenha->token) ?></td>
                <td><?= h($alteracaoSenha->validade) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $alteracaoSenha->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $alteracaoSenha->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $alteracaoSenha->id], ['confirm' => __('Are you sure you want to delete # {0}?', $alteracaoSenha->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
