<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProgramarDesativarProduto $programarDesativarProduto
 */
$listaDiaSemana = \App\Model\Entity\HorariosAtendimento::getDiaSemanaList();
?>
<div class="col-sm-12">
    <h3><?= h($programarDesativarProduto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($programarDesativarProduto->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Produto') ?></th>
            <td><?= $programarDesativarProduto->has('produto') ? $this->Html->link($programarDesativarProduto->produto->nome_produto, ['controller' => 'Produtos', 'action' => 'view', $programarDesativarProduto->produto->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dia Semana') ?></th>
            <td><?= $listaDiaSemana[$programarDesativarProduto->dia_semana] ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Programação Ativa') ?></th>
            <td><?= $programarDesativarProduto->programacao_ativa ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
</div>
