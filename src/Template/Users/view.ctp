<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$listTipo = \App\Model\Entity\User::getTipoListAll();
$listTipoContato =\App\Model\Entity\UsersContato::getTipoList();
?>
<div class="col-sm-12">
    <h3>Usuário #<?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('#') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
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
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= $listTipo[$user->tipo] ?></td>
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
    <div class="related">
        <h4><?= __('Contatos:') ?></h4>
        <?php if (!empty($contatos)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('#') ?></th>
                    <th scope="col"><?= __('Tipo') ?></th>
                    <th scope="col"><?= __('Contato') ?></th>
                </tr>
                <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td><?= h($contato->id) ?></td>
                        <td><?= $listTipoContato[$contato->tipo] ?></td>
                        <td><?= h($contato->contato) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
