<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>Caso necessite fazer o calculo para o dia de hoje informe na data de inicio hoje e na data de fim o dia seguinte.</span>
    </div>
    <h3>Calcular Comissão Entregador</h3>
    <?php echo $this->Form->create(false); ?>
    <?php
        echo $this->Form->control('entregador', ['options' => $entregadores, 'required' => 'required']);
        echo $this->Form->label('Inicio');
    ?>
    <input required="required" name="inicio_periodo" id="inicio_periodo" type="date">
    <?php
        echo $this->Form->label('Fim');
    ?>
    <input required="required" name="fim_periodo" id="fim_periodo" type="date">
    <?php
    echo $this->Form->label('Porcentagem Entregador');
    ?>
    <input required="required" min="0" max="100" name="porcentagem" id="porcentagem" type="number">
    <input type="checkbox" name="conta_pagar" id="conta_pagar" value=""> Gerar Conta a Pagar
    <br>
    <?= $this->Form->button(__('Calcular')) ?>
    <?= $this->Form->end() ?>
</div>
