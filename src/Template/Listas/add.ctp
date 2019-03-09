<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lista $lista
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($lista) ?>
    <fieldset>
        <legend><?= __('Adicionar Lista') ?></legend>
        <?php
        echo $this->Form->control('nome_lista', ['label' => 'Nome']);
            echo $this->Form->control('descricao_lista', ['label' => 'Descrição']);
            echo $this->Form->control('titulo_lista', ['label' => 'Título']);
            echo $this->Form->control('max_opcoes_selecionadas_lista', ['label' => 'Máximo opções selecionaveis']);
            echo $this->Form->control('min_opcoes_selecionadas_lista', ['label' => 'Minimo opções selecionaveis']);
        ?>
    </fieldset>
    <br />
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
