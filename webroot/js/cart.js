function removeItemCarrinho(idItemCarrinho) {
    jQuery.ajax({
        url: "../itens-carrinhos/removeItemCarrinho/"+idItemCarrinho,
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            if (data.itemExcluido) {
                alert('Item excluído do carrinho');
                setTimeout("location.reload(true);",0);
            } else {
                alert('NÃO FOI POSSIVEL EXCLUIR O ITEM DO CARRINHO');
            }
        },
        error: function (data) {

            alert('NÃO FOI POSSIVEL EXCLUIR O ITEM DO CARRINHO');
        }
    });
}

function fecharCarrinho() {
    var endereco = $( "select option:selected");
    jQuery.ajax({
        url: "../pedidos/generatePedido/"+endereco.val(),
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            console.log(data);
            if(data.success){
                alert('Confirmacao de itens concluida com sucesso');
                $(location).attr('href', '/pages/confirmar?pedido='+data.pedido);
            }else{
                alert('Nao foi possivel confirmar os itens do pedido');
            }
        },
        error: function (data) {
            alert('NÃO FOI POSSIVEL GERAR UM NOVO PEDIDO COM SEU CARRINHO');
        }
    });
}
