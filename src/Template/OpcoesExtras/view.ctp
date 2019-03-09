<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OpcoesExtra $opcoesExtra
 */
?>
<div class="col-sm-12">
    <h3>Visualizar Adicional $<?= h($opcoesExtra->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($opcoesExtra->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($opcoesExtra->nome_adicional) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descrição') ?></th>
            <td><?= h($opcoesExtra->descricao_adicional) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valor') ?></th>
            <td><?= $this->Number->format($opcoesExtra->valor_adicional) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Listas que possuem este adicional:') ?></h4>
        <?php if (!empty($opcoesExtra->listas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('Nome') ?></th>
                <th scope="col"><?= __('Descrição') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Opções selecionaveis') ?></th>
            </tr>
            <?php foreach ($opcoesExtra->listas as $listas): ?>
            <tr>
                <td><?= h($listas->id) ?></td>
                <td><?= h($listas->nome_lista) ?></td>
                <td><?= h($listas->descricao_lista) ?></td>
                <td><?= h($listas->titulo_lista) ?></td>
                <td><?= h($listas->max_opcoes_selecionadas_lista) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
