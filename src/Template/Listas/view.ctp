<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lista $lista
 */
?>
<div class="col-sm-12">
    <h3>Lista #<?= h($lista->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($lista->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($lista->nome_lista) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Título') ?></th>
            <td><?= h($lista->titulo_lista) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descrição') ?></th>
            <td><?= h($lista->descricao_lista) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Opções selecionaveis') ?></th>
            <td><?= $this->Number->format($lista->max_opcoes_selecionadas_lista) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Adicionais relacionados a está lista:') ?></h4>
        <?php if (!empty($lista->opcoes_extras)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('#') ?></th>
                <th scope="col"><?= __('Nome') ?></th>
                <th scope="col"><?= __('Descrição') ?></th>
                <th scope="col"><?= __('Valor') ?></th>
            </tr>
            <?php foreach ($lista->opcoes_extras as $opcoesExtras): ?>
            <tr>
                <td><?= h($opcoesExtras->id) ?></td>
                <td><?= h($opcoesExtras->nome_adicional) ?></td>
                <td><?= h($opcoesExtras->descricao_adicional) ?></td>
                <td><?= h($opcoesExtras->valor_adicional) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
