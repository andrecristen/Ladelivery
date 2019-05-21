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
        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-plus')).' Adicionar Novo', array('controller' => 'enderecos', 'action' => 'addEnderecoCliente'), array('escape' => false , 'class' => 'btn btn-primary')) ?>
    </div>
    <br/>
    <br/>
    <div class="alert alert-primary" role="alert">
        <i class="fas fa-exclamation-triangle"></i> <span style="font-weight: bold">Atenção!</span>
        <br>
        Caso você possua mais de um endereço, edite um endereço de cada vez e salve antes de editar o próximo.
    </div>
    <?php
    $enderecoModel = new \App\Model\Entity\Endereco();
    $enderecosCount = 0;
    foreach ($enderecos as $endereco) {
        $enderecosCount = $enderecosCount + 1;
        ?>
        <?= $this->Form->create($endereco, ['action' => '/meus-enderecos/']) ?>
        <fieldset>
            <legend><?= 'Endereço Nº' . $enderecosCount ?> - <a style="margin-bottom: 2px;" href="/enderecos/excluir-endereco-cliente/<?= $endereco->id ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a></legend>
            <?php
            echo $this->Form->control('rua');
            echo $this->Form->control('numero', ['required' => 'required']);
            echo $this->Form->control('bairro');
            echo $this->Form->control('cidade');
            echo $this->Form->control('cep', ['label'=>'CEP']);
            echo $this->Form->control('complemento', ['required'=>'required']);
            echo $this->Form->control('estado', ['options' => $enderecoModel->getEstados()]);
            ?>
            <br/>
        </fieldset>
        <?= $this->Form->button(__('Salvar')) ?>
        <?= $this->Form->end() ?>
        <br/>
    <?php }
    if ($enderecosCount == 0) {
        echo '<h1>Você ainda não possui endereços cadastrados</h1>';
    }
    ?>
</div>