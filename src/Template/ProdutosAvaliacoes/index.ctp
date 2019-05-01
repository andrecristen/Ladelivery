<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProdutosAvaliaco[]|\Cake\Collection\CollectionInterface $produtosAvaliacoes
 */
?>
<div class="produtosAvaliacoes index large-9 medium-8 columns content">
    <h3><?= __('Produtos Avaliacoes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('produto_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nota') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comentario') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtosAvaliacoes as $produtosAvaliaco): ?>
            <tr>
                <td><?= $this->Number->format($produtosAvaliaco->id) ?></td>
                <td><?= $produtosAvaliaco->has('produto') ? $this->Html->link($produtosAvaliaco->produto->nome_produto, ['controller' => 'Produtos', 'action' => 'view', $produtosAvaliaco->produto->id]) : '' ?></td>
                <td><?= $produtosAvaliaco->has('user') ? $this->Html->link($produtosAvaliaco->user->nome_completo, ['controller' => 'Users', 'action' => 'view', $produtosAvaliaco->user->id]) : '' ?></td>
                <td><?= $this->Number->format($produtosAvaliaco->nota) ?></td>
                <td><?= h($produtosAvaliaco->comentario) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $produtosAvaliaco->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $produtosAvaliaco->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $produtosAvaliaco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $produtosAvaliaco->id)]) ?>
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
