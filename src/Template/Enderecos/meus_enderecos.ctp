<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<div class="col-sm-12">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/" class="pull-left btn btn-danger"><i class="fas fa-home"></i> Início</a>
        <a href="/users/profile/<?= $_SESSION['Auth']['User']['id'] ?>" class="pull-left btn btn-success"><i class="fas fa-user-circle"></i> Minha Conta</a>
        <a href="/enderecos/add-endereco-cliente" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar Novo</a>
    </div>
    <br/>
    <br/>
    <div class="alert alert-primary" role="alert">
        Atenção! Edite um endereço de cada vez e salve antes de editar o próximo.
    </div>
    <?php
    $enderecoModel = new \App\Model\Entity\Endereco();
    $enderecosCount = 0;
    foreach ($enderecos as $endereco) {
        $enderecosCount = $enderecosCount + 1;
        ?>
        <?= $this->Form->create($endereco, ['action' => '/meus-enderecos/']) ?>
        <fieldset>
            <legend><?= 'Endereço #' . $endereco->id ?> - <a style="margin-bottom: 2px;" href="/enderecos/excluir-endereco-cliente/<?= $endereco->id ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a></legend>
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