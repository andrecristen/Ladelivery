<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoogleMapsApiKey $googleMapsApiKey
 */

?>
<div class="col-sm-12">
    <?= $this->Form->create($googleMapsApiKey) ?>
    <fieldset>
        <legend><?= __('Adicionar Google Maps Api Key - Não alterar sem ajuda do suporte') ?></legend>
        <?php
        echo $this->Form->control('empresa_id', ['options' => $empresas]);
        echo $this->Form->control('api_key');
        echo $this->Form->control('ativa', ['options' => [1 => 'Sim', 2 => 'Não']]);
        ?>
        <br/>
    </fieldset>
    <?= $this->Form->button(__('Adicionar')) ?>
    <?= $this->Form->end() ?>
</div>
