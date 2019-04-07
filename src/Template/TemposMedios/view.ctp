<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TemposMedio $temposMedio
 */
?>
<div class="col-sm-12">
    <h3><?= h($temposMedio->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($temposMedio->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($temposMedio->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('#Empresa') ?></th>
            <td><?= $this->Number->format($temposMedio->empresa_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tempo Medio Producao Minutos') ?></th>
            <td><?= $this->Number->format($temposMedio->tempo_medio_producao_minutos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= $temposMedio->ativo ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
</div>
