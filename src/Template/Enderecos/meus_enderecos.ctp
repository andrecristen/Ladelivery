<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$siteUtils = new \App\Model\Utils\SiteUtils();
$siteUtils->menuSite();
$enderecoModel = new \App\Model\Entity\Endereco();
$listaEstados = $enderecoModel->getEstados();
?>
<div style="margin-top: 67px;" class="col-sm-12">
    <div class="btn-group" role="group" aria-label="Basic example">
        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-plus')).' Adicionar Novo', array('controller' => 'enderecos', 'action' => 'addEnderecoCliente'), array('escape' => false , 'class' => 'btn btn-success')) ?>
    </div>
    <br/>
    <br/>
    <?php
    $enderecosCount = 0;
    foreach ($enderecos as $endereco) {
        $enderecosCount = $enderecosCount + 1;
        ?>
        <div class="alert alert-info">
            <strong><?= 'Endereço Nº' . $enderecosCount ?></strong>
            <fieldset>
                <legend></legend>
                <span>Rua: <?= $endereco->rua?></span>
                <br>
                <span>Número: <?= $endereco->numero?></span>
                <br>
                <span>Bairro: <?= $endereco->bairro?></span>
                <br>
                <span>Cidade: <?= $endereco->cidade?></span>
                <br>
                <span>Estado: <?= $listaEstados[$endereco->estado]?></span>
                <br>
                <span>CEP: <?= $endereco->cep?></span>
                <br>
                <span>Complemento: <?= $endereco->complemento?></span>
                <br>
            </fieldset>
            <fieldset>
                <legend></legend>
                <br>
                <a style="margin-bottom: 2px;" href="/enderecos/excluir-endereco-cliente/<?= $endereco->id ?>" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i> Excluir</a>
                <a style="margin-bottom: 2px;" href="/enderecos/editar-endereco-cliente/<?= $endereco->id ?>" class="btn btn-sm btn-primary"><i class="far fa-edit"></i> Editar</a>
            </fieldset>
        </div>
    <?php }
    if ($enderecosCount == 0) {
        echo '<h1>Você ainda não possui endereços cadastrados, por favor adicione pelo menos um...</h1>';
    }
    ?>
</div>