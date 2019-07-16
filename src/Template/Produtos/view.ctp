<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Produto $produto
 */
?>
<div class="col-sm-12">
    <h3>Produto #<?= h($produto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($produto->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($produto->nome_produto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Categoria') ?></th>
            <td><?= $produto->has('categorias_produto') ? $this->Html->link($produto->categorias_produto->nome_categoria, ['controller' => 'CategoriasProdutos', 'action' => 'view', $produto->categorias_produto->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Preço') ?></th>
            <td><?= $this->Number->format($produto->preco_produto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descrição') ?></th>
            <td><?= h($produto->descricao_produto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= $produto->ativo_produto ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
</div>
