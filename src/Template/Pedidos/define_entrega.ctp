<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheVersion = $cacheControl->getCacheVersion();
$empresaUtils = new \App\Model\Utils\EmpresaUtils();
?>
<?= $this->Html->script('pedido.js' . $cacheVersion); ?>
<div class="col-sm-12">
    <?= $this->Form->create($pedido) ?>
    <fieldset>
        <legend>Entrega do Pedido</legend>
        <br>
        <?php
        echo $this->Form->control('id', ['label' => 'Pedido', 'disabled' => 'disabled', 'type' => 'text', 'required' => false]);
        if($pedido->user_id !== $empresaUtils->getUserEmpresaModel()->user_id){
            echo $this->Form->control('user_id', ['label' => 'Cliente', 'options' => $users, 'disabled' => 'disabled']);
        }else{
            echo $this->Form->control('cliente', ['label' => 'Cliente', 'disabled' => 'disabled']);
        }
        ?>
        <?php
        if($pedido->user_id !== $empresaUtils->getUserEmpresaModel()->user_id){
            echo '<br/>';
            echo '<div class="form-check">
                    <input onchange="alternateFieldsEndereco(this)" type="checkbox" class="form-check-input" name="endereco" id="endereco">&nbsp;
                    <label class="form-check-label" for="endereco">Utilizar novo endereço?</label>
                  </div>';
            echo '<div id="area-endereco">';
            echo $this->Form->control('endereco_id', ['label' => 'Endereço', 'options' => $enderecosCliente, 'required' => true]);
            echo '<br/>';
            echo '</div>';
            echo '<div id="area-new-endereco" style="display: none">';
            echo '<fieldset><legend>Endereço de entrega</legend>';
            echo $this->Form->control('rua', ['required' => false]);
            echo $this->Form->control('numero', ['required' => false]);
            echo $this->Form->control('bairro', ['required' => false]);
            echo $this->Form->control('cidade', ['required' => false]);
            echo $this->Form->control('cep', ['class' => 'cep', 'required' => false]);
            echo $this->Form->control('complemento', ['required' => false]);
            echo $this->Form->control('estado', ['options' => \App\Model\Entity\Endereco::getEstados(), 'required' => false]);
            echo '</fieldset>';
            echo '</div>';
        }else{
            echo '<div id="area-new-endereco">';
            echo '<div style="display: none" class="form-check">
                    <input checked type="checkbox" class="form-check-input" name="endereco" id="endereco">&nbsp;
                  </div>';
            echo '<div class="alert alert-info"><span>O cliente do pedido não está cadastrado no sistema, por favor informe o endereço manualmente.</span></div>';
            echo '<fieldset><legend>Endereço de entrega</legend>';
            echo $this->Form->control('rua', ['required' => true]);
            echo $this->Form->control('numero', ['required' => true]);
            echo $this->Form->control('bairro', ['required' => true]);
            echo $this->Form->control('cidade', ['required' => true]);
            echo $this->Form->control('cep', ['class' => 'cep', 'required' => true]);
            echo $this->Form->control('complemento', ['required' => true]);
            echo $this->Form->control('estado', ['options' => \App\Model\Entity\Endereco::getEstados(), 'required' => true]);
            echo '</fieldset>';
            echo '</div>';
        }
        ?>
        <div id="area-valor">
            <div class="alert alert-info">
                <span>Caso você não preencha o campo valor, o sistema irá calcular automaticamente com base no endereço de entrega.</span>
            </div>
            <?php
            echo $this->Form->control('valor_entrega', ['label' => 'Valor', 'required' => false, 'type' => 'number']);
            ?>
        </div>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Definir Entrega')) ?>
    <?= $this->Form->end() ?>
</div>
