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
                setTimeout(
                    location.reload(true),
                    2000
                );
            } else {
                alertify.error('NÃO FOI POSSIVEL EXCLUIR O ITEM DO CARRINHO');
            }
        },
        error: function (data) {
            alertify.error('NÃO FOI POSSIVEL EXCLUIR O ITEM DO CARRINHO');
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
                alertify.success('Confirmação de itens concluida com sucesso');
                $(location).attr('href', '/pages/confirmar');
            }else{
                alertify.error('Não foi possivel confirmar os itens do pedido');
                $("#btnFecharCarrinho").attr("disabled", false);
            }
        },
        error: function (data) {
            alertify.error('Não foi possivel confirmar os itens do pedido');
            $("#btnFecharCarrinho").attr("disabled", false);
        }
    });
}
