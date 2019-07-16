<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Midia $midia
 */
$tipoMidiaList = \App\Model\Entity\Midia::getTipoList();
?>
<div class="col-sm-12">
    <h3>Mídia #<?= h($midia->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($midia->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Path Midia') ?></th>
            <td><?= h($midia->path_midia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Empresa Id') ?></th>
            <td><?= $this->Number->format($midia->empresa_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo Midia') ?></th>
            <td><?= $tipoMidiaList[$midia->tipo_midia] ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Midia') ?></th>
            <td><?= h($midia->nome_midia) ?></td>
        </tr>
    </table>
    <?php
        echo '<h5>Visualizar:</h5>';
        echo '<br>';
        echo $this->Html->image($midia->path_midia);
    ?>
</div>
