<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListasProduto $listasProduto
 */
?>
<div class="col-sm-12">
    <h3><?= h($listasProduto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Produto') ?></th>
            <td><?= $listasProduto->has('produto') ? $this->Html->link($listasProduto->produto->nome_produto, ['controller' => 'Produtos', 'action' => 'view', $listasProduto->produto->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lista') ?></th>
            <td><?= $listasProduto->has('lista') ? $this->Html->link($listasProduto->lista->id, ['controller' => 'Listas', 'action' => 'view', $listasProduto->lista->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($listasProduto->id) ?></td>
        </tr>
    </table>
</div>
