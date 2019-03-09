<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CupomSite $cupomSite
 */
?>
<div class="col-sm-12">
    <?= $this->Form->create($cupomSite) ?>
    <fieldset>
        <legend><?= __('Adicionar Cupom Site') ?></legend>
        <?php
            echo $this->Form->control('nome_cupom');
            echo $this->Form->control('vezes_usado', ['value'=> 0, 'disabled'=>'disabled']);
            echo $this->Form->control('maximo_vezes_usar');
            echo $this->Form->control('valor_desconto');
            echo $this->Form->control('porcentagem');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
