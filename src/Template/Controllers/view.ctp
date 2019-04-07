<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Controller $controller
 */
?>
<div class="col-sm-12">
    <h3><?= h($controller->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($controller->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome Controlador') ?></th>
            <td><?= h($controller->nome_controlador) ?></td>
        </tr>
    </table>
</div>
