function aplicarCupom() {
    var cupom = $("#promo-code").val();
    jQuery.ajax({
        url: "../pedidos/aplicarCupom/" + cupom,
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            if (data.success) {
                alertify.alert('Sucesso', 'Cupom aplicado com sucesso', function () {
                    $(location).attr('href', '/pages/confirmar');
                });
            } else {
                alertify.error('Nenhum cupom adicionado');
            }
        },
    });
}

function confirmar() {
    if (verificaEnderecoPreenchido()) {
        var selected = $('option:selected');
        jQuery.ajax({
            url: "../pedidos/confirmarPedidoAberto/" + selected.val(),
            method: "GET",
            async: false,
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    alertify.alert('Show!', 'Seu pedido foi confirmado e agora esta esperando aprovação da empresa. Não deixe de acompanhar o status do seu pedido (Pode ser visto em Minha Conta ação Meus Pedidos)', function () {
                        $(location).attr('href', '/pages/');
                    });
                } else {
                    alertify.error('Não foi possivel confirmar este pedido, tente novamente! Se o problema persistir, contate a empresa');
                }
            },
            error: function (data) {
                alert('ERRO AO REALIZAR OPERACAO');
            }
        });
    } else {
        alertify.error('Selecione uma forma de pagamento');
    }
}

function calcularAcrecimo() {
    if (verificaEnderecoPreenchido()) {
        var selected = $('option:selected');
        if (selected.attr('troco')) {
            solicitarTroco();
        } else {
            requestCalcularAcrescimo(selected.val());
        }

    }
}

function requestCalcularAcrescimo(formaPagamentoId) {
    jQuery.ajax({
        url: "../pedidos/calcularAcrescimo/" + formaPagamentoId,
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            if (data.success) {
                $(location).attr('href', '/pages/confirmar');
            } else {
                alertify.alert('Opss!', 'Não foi possível calcular acréscimos para esta forma de pagamento', function () {
                    $(location).attr('href', '/pages/confirmar');
                });
            }
        },
        error: function (data) {
            alert('ERRO AO REALIZAR OPERACAO');
            $(location).attr('href', '/pages/confirmar');
        }
    });
}

function solicitarTroco() {
    $("#trocoInput").val('0');
    $("#openModal").click();
}

function confirmarTroco() {
    $("#closeModal").click();
    var troco = $("#trocoInput").val();
    gravaTrocoPara(troco);
}

function gravaTrocoPara(troco) {
    var selected = $('option:selected');
    jQuery.ajax({
        url: "../pedidos/saveTrocoPara/" + troco,
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            if (data.success) {
                requestCalcularAcrescimo(selected.val());
            } else {
                alertify.alert('Opss!', 'Erro ao gravar troco', function () {
                    $(location).attr('href', '/pages/confirmar');
                });
            }
        },
        error: function (data) {
            alertify.alert('Opss!', 'Erro ao gravar troco', function () {
                $(location).attr('href', '/pages/confirmar');
            });
        }
    });
}

function cancelar() {
    jQuery.ajax({
        url: "../pedidos/rejeitarPedidoAberto/",
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            if (data.success) {
                alertify.alert('Pedido Cancelado','Pedido cancelado com sucesso', function () {
                    $(location).attr('href', '/pages/');
                });
            } else {
                alertify.error('Não foi possivel cancelar este pedido');
                $(location).attr('href', '/pages/confirmar');
            }
        },
    });
}

function verificaEnderecoPreenchido() {
    var selects = $('select');
    try {
        selects.each(certificaMinimoPreechido);
        return true;
    } catch (e) {
        return false;
    }

}

function certificaMinimoPreechido(index, element) {
    var minOptions = 1;
    var selected = $('option:selected', element);
    if (selected.length < minOptions || selected.val() == "false") {
        throw new Error('Não selecionada forma de pagamento');
        return;
    }
}