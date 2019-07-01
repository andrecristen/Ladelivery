<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empresa $empresa
 */
$listTipo = \App\Model\Entity\Empresa::getTipoList();
$listTipoFrete = \App\Model\Entity\Empresa::getTipoFreteList();
?>
<div class="col-sm-12">
    <h3><?= h($empresa->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($empresa->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Fantasia') ?></th>
            <td><?= h($empresa->nome_fantasia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cnpj') ?></th>
            <td><?= h($empresa->cnpj) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ie') ?></th>
            <td><?= h($empresa->ie) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= $listTipo[$empresa->tipo_empresa] ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo Frete') ?></th>
            <td><?= $listTipoFrete[$empresa->tipo_frete] ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativa') ?></th>
            <td><?= $empresa->ativa ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
    <div class="related">
        <?php if (!empty($empresa->tempos_medios)): ?>
        <h4><?= __('Tempos de Producao Relacionados') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Empresa Id') ?></th>
                <th scope="col"><?= __('Nome') ?></th>
                <th scope="col"><?= __('Tempo Medio Producao Minutos') ?></th>
                <th scope="col"><?= __('Ativo') ?></th>
            </tr>
            <?php foreach ($empresa->tempos_medios as $temposMedios): ?>
            <tr>
                <td><?= h($temposMedios->id) ?></td>
                <td><?= h($temposMedios->empresa_id) ?></td>
                <td><?= h($temposMedios->nome) ?></td>
                <td><?= h($temposMedios->tempo_medio_producao_minutos) ?></td>
                <td><?= h($temposMedios->ativo) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

