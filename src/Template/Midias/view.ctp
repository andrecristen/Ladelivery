<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Midia $midia
 */
?>
<div class="col-sm-12">
    <h3><?= h($midia->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Path Midia') ?></th>
            <td><?= h($midia->path_midia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($midia->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Empresa Id') ?></th>
            <td><?= $this->Number->format($midia->empresa_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo Midia') ?></th>
            <td><?= $this->Number->format($midia->tipo_midia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Midia') ?></th>
            <td><?= $this->Number->format($midia->nome_midia) ?></td>
        </tr>
    </table>
    <?php
        echo '<label>Visualizar:</label>';
        echo '<br>';
        echo $this->Html->image($midia->path_midia);
    ?>
</div>
