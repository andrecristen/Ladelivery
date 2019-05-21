<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <div class="btn-group" role="group" aria-label="Basic example">
        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-plus')).' Adicionar Novo', array('controller' => 'usersContatos', 'action' => 'addContatoCliente'), array('escape' => false , 'class' => 'btn btn-primary')) ?>
    </div>
    <br/>
    <br/>
    <div class="alert alert-primary" role="alert">
        <i class="fas fa-exclamation-triangle"></i> <span style="font-weight: bold">Atenção!</span>
        <br>
        Caso você possua mais de um contato, edite um contato de cada vez e salve antes de editar o próximo.
    </div>
    <?php
    $contatosCount = 0;
    foreach ($usersContatos as $contato) {
        $contatosCount = $contatosCount + 1;
        ?>
        <?= $this->Form->create($contato, ['action' => '/meus-contatos/']) ?>
        <fieldset>
            <legend>Contato Nº<?= $contatosCount?></legend>
            <?php
            echo $this->Form->control('tipo', ['options' => \App\Model\Entity\UsersContato::getTipoList()]);
            echo $this->Form->control('contato');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Salvar')) ?>
        <?= $this->Form->end() ?>
        <br>
    <?php }
    if ($contatosCount == 0) {
        echo '<h1>Você ainda não possui contatos cadastrados</h1>';
    }
    ?>
</div>
