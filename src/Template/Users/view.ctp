<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="col-sm-12">
    <h3>Usuário #<?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome Completo') ?></th>
            <td><?= h($user->nome_completo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apelido') ?></th>
            <td><?= h($user->apelido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login') ?></th>
            <td><?= h($user->login) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= $this->Number->format($user->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dia Nascimento') ?></th>
            <td><?= $this->Number->format($user->dia_nascimento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mes Nascimento') ?></th>
            <td><?= $this->Number->format($user->mes_nascimento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ano Nascimento') ?></th>
            <td><?= $this->Number->format($user->ano_nascimento) ?></td>
        </tr>
    </table>
</div>
