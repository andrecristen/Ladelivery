function removeItemCarrinho(idItemCarrinho) {
    jQuery.ajax({
        url: "../itens-carrinhos/removeItemCarrinho/"+idItemCarrinho,
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            if (data.itemExcluido) {
                alertify.warning('Item excluído do carrinho');
                alertify.notify('Recarregando carrinho');
                $(".div-ajax-carregamento-pagina").show();
                setTimeout(
                    location.reload(),
                    8000
                );
            } else {
                alertify.alert('NÃO FOI POSSIVEL EXCLUIR O ITEM DO CARRINHO');
            }
        },
        error: function (data) {
            alertify.alert('NÃO FOI POSSIVEL EXCLUIR O ITEM DO CARRINHO');
        }
    });
}

function scrollToConfirm() {
    $('html, body').animate({
        scrollTop: $(document).height()
    }, 700);
}

function fecharCarrinho() {
    var endereco = $( "select option:selected");
    $("#btnFecharCarrinho").attr("disabled", true);
    jQuery.ajax({
        url: "../pedidos/generatePedido/"+endereco.val(),
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            if(data.success){
                alertify.success(data.message);
                $(location).attr('href', '/pages/confirmar');
            }else{
                alertify.error(data.message);
                $("#btnFecharCarrinho").attr("disabled", false);
            }
        },
        error: function (data) {
            alertify.error(data.message);
            $("#btnFecharCarrinho").attr("disabled", false);
        }
    });
}
