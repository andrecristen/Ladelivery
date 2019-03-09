<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListasProduto $listasProduto
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($listasProduto) ?>
    <fieldset>
        <legend><?= __('Relacionar Lista X Produto') ?></legend>
        <?php
            echo $this->Form->control('produto_id', ['options' => $produtos]);
            echo $this->Form->control('lista_id', ['options' => $listas]);
        ?>
    </fieldset>
    <br />
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
