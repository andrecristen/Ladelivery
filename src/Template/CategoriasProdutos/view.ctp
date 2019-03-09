<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriasProduto $categoriasProduto
 */
?>
<div class="col-sm-12">
    <h3>Visualizar Categoria #<?= h($categoriasProduto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome Categoria') ?></th>
            <td><?= h($categoriasProduto->nome_categoria) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($categoriasProduto->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descrição') ?></th>
            <td><?= h($categoriasProduto->descricao_categoria) ?></td>
        </tr>
    </table>
    <div class="related">
        <br>
        <h4><?= __('Produtos que fazem parte desta categoria:') ?></h4>
        <?php if (!empty($categoriasProduto->produtos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('Nome') ?></th>
                <th scope="col"><?= __('Descricao') ?></th>
                <th scope="col"><?= __('Preço') ?></th>
                <th scope="col"><?= __('Ativo') ?></th>
            </tr>
            <?php foreach ($categoriasProduto->produtos as $produtos): ?>
            <tr>
                <td><?= h($produtos->id) ?></td>
                <td><?= h($produtos->nome_produto) ?></td>
                <td><?= h($produtos->descricao_produto) ?></td>
                <td><?= h($produtos->preco_produto) ?></td>
                <td><?= $produtos->ativo_produto ? __('Sim') : __('Não'); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
