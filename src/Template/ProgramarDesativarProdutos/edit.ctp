<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProgramarDesativarProduto $programarDesativarProduto
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($programarDesativarProduto) ?>
    <fieldset>
        <legend><?= __('Editar Dia Semana Desativado') ?></legend>
        <?php
        echo $this->Form->control('produto_id', ['options' => $produtos]);
        echo $this->Form->control('dia_semana', ['options' => \App\Model\Entity\HorariosAtendimento::getDiaSemanaList()]);
        echo $this->Form->control('programacao_ativa');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
