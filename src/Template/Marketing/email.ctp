<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
?>
<script src="/ladev/ckeditor/ckeditor.js"></script>
<div class="col-sm-12">
    <div class="alert alert-info">
        <span>Atenção! Os emails enviados aqui serão destinados a todos os clientes cadastrados no sistema, o que pode acarretar lentidão no envio. Certifique-se de só fechar a página após o carregamento completo, caso contrário nem todos os clientes serão notificados.</span>
    </div>
    <form method="post" accept-charset="utf-8" action="/marketing/email">
        <div style="display:none;"><input type="hidden" name="_method" value="POST"><input type="hidden" name="_csrfToken" autocomplete="off" value="1126dce882054739c38b1f1b71060a7762a1936d6a002d0a322885d1fcd516aaa7b7d3b013be4af00728e4dbf7a56ff65f7ece7c7a8e5c9efb941d6fe320f1a1"></div>    <fieldset>
            <div class="input text required">
                <label for="nome-midia">Titulo</label>
                <input type="text" name="titulo" required="required" maxlength="600" id="titulo">
            </div>
            <div class="input text required">
                <label for="template">Email</label>
                <textarea required="required" ng-model="data.template" name="template" id="template" rows="10" cols="80">
                    Construa seu template aqui...
                </textarea>
            </div>
            <br>
        <button type="submit">Enviar</button>
    </form>
</div>
<script>
    CKEDITOR.replace( 'template' );
</script>

