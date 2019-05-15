<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<script src="/ladev/editor/editor.js"></script>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>Atenção! Os emails enviados aqui serão destinados a todos os clientes cadastrados no sistema, o que pode acarretar lentidão no envio. Certifique-se de só fechar a página após o carregamento completo, caso contrário nem todos os clientes serão notificados.</span>
    </div>
    <?php echo $this->Form->create( false ,array('type' => 'file')); ?>
        <div class="input text required">
                <label for="nome-midia">Titulo</label>
                <input type="text" name="titulo" required="required" maxlength="600" id="titulo">
            </div>
            <div class="input text required">
                <label for="template">Email</label>
                <div id="sample">
                    <textarea name="template" id="template" style="height: 500px"></textarea>
            </div>
            <br>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
<script>
    $(document).ready(function () {
        nicEditors.allTextAreas()
    });
</script>

