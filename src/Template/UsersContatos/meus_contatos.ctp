<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
$tipoContatoList = \App\Model\Entity\UsersContato::getTipoList();
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <div class="btn-group" role="group" aria-label="Basic example">
        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-plus')).' Adicionar Novo', array('controller' => 'usersContatos', 'action' => 'addContatoCliente'), array('escape' => false , 'class' => 'btn btn-success')) ?>
    </div>
    <br/>
    <br/>
    <?php
    $contatosCount = 0;
    foreach ($usersContatos as $contato) {
        $contatosCount = $contatosCount + 1;
        ?>
        <div class="alert alert-info">
            <strong><?= 'Conato Nº' . $contatosCount ?></strong>
            <fieldset>
                <legend></legend>
                <span>Tipo: <?= $tipoContatoList[$contato->tipo]?></span>
                <br>
                <span>Contato: <?= $contato->contato?></span>
                <br>
            </fieldset>
            <fieldset>
                <legend></legend>
                <br>
                <a style="margin-bottom: 2px;" href="/users-contatos/excluir-contato-cliente/<?= $contato->id ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i> Excluir</a>
                <a style="margin-bottom: 2px;" href="/users-contatos/editar-contato-cliente/<?= $contato->id ?>" class="btn btn-sm btn-primary"><i class="far fa-edit"></i> Editar</a>
            </fieldset>
        </div>
    <?php }
    if ($contatosCount == 0) {
        echo '<h1>Você ainda não possui contatos cadastrados, por favor cadastre ao menos um...</h1>';
    }
    ?>
</div>
