const descricoes = [];
$(document).ready(function () {
    allSelectMultiple();
});

function allSelectMultiple() {
    $('select').selectpicker({
        title: "Nada selecionado",
        liveSearch: true,
        showContent: true,
        maxOptionsText: "Selecione somente {n} opções",
        width: '100%'
    });
}

function findProduto(produtoId) {
    realFindProduto("/produtos/getProduto/" + parseInt(produtoId) , false, produtoId);
}

function realFindProduto(url, isAdmin, produtoId) {
    jQuery.ajax({
        url: url,
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            $("#idProduto").val(data.id);
            $("#nomeProduto").val(data.nome_produto);
            $("#precoProdutoOriginal").val(parseFloat(data.preco_produto));
            $("#precoProduto").val(parseFloat(data.preco_produto));
            $("#descricaoProduto").val(data.descricao_produto);
            $(".div-ajax-carregamento-pagina").css('display', 'none');
            if(isAdmin){
                findLists(produtoId);
            }else{
                findListsAdmin(produtoId);
            }

        },
        error: function (data) {
            $(".div-ajax-carregamento-pagina").hide();
        }
    });
}


function findProdutoAdmin(produtoId) {
    realFindProduto("../../produtos/getProduto/" + parseInt(produtoId) , false, produtoId);
}

function openModalAddCart(produtoId, isAdmin) {
    $(".div-ajax-carregamento-pagina").show();
    setTimeout(function () {

        if(isAdmin){
            findProdutoAdmin(produtoId)
        }else{
            findProduto(produtoId);
        }
        openModal();
        $(".div-ajax-carregamento-pagina").hide();
    }, 50);

}

function montaListasAdicionais(data) {
    var listasAdicionadas = 0;
    for (var i = 0; i < data.listas.length; i++) {
        listasAdicionadas++;
        var label = document.createElement('h4');
        label.textContent = data.listas[i].titulo_lista.toString() + ':';
        document.getElementById('contentOptions').appendChild(label);
        var select = document.createElement('select');
        select.onchange = function () {
            readequaValorProduto();
        };
        select.id = data.listas[i].id;
        select.setAttribute('data-max-options', data.listas[i].max_opcoes_selecionadas_lista);
        select.setAttribute('data-min-options', data.listas[i].min_opcoes_selecionadas_lista);
        select.setAttribute('titleLista', data.listas[i].titulo_lista.toString());
        select.setAttribute('multiple', 'multiple');
        if(data.options[data.listas[i].id] !== undefined){
            for (var j = 0; j < data.options[data.listas[i].id].length; j++) {
                var option = document.createElement('option');
                option.setAttribute('data-content', data.options[data.listas[i].id][j][0].nome_adicional + ' +R$ '+data.options[data.listas[i].id][j][0].valor_adicional + ' <button title="Visualizar Descrição da Opção" style="position: absolute; right: 5px" class="btn btn-sm btn-info" onclick="showDescricao('+data.options[data.listas[i].id][j][0].id+', event)"><i class="far fa-eye"></i></button>');
                option.setAttribute('title', data.options[data.listas[i].id][j][0].nome_adicional + ' +R$ '+data.options[data.listas[i].id][j][0].valor_adicional);
                descricoes[data.options[data.listas[i].id][j][0].id] = data.options[data.listas[i].id][j][0].descricao_adicional;
                option.setAttribute('idopcional', data.options[data.listas[i].id][j][0].id);
                option.setAttribute('valoradicional', data.options[data.listas[i].id][j][0].valor_adicional);
                select.appendChild(option);
            }
        }
        $('#contentOptions').append(select);
        allSelectMultiple();
    }
    if (listasAdicionadas === 0) {
        var divAlert = document.createElement('div');
        divAlert.setAttribute('class', 'alert alert-danger');
        var icon = document.createElement('i');
        icon.setAttribute('class', 'far fa-grin-beam-sweat fa-3x');
        divAlert.appendChild(icon);
        var span = document.createElement('span');
        span.textContent = 'Ahh que pena este item não permite isso!';
        divAlert.appendChild(span);
        document.getElementById('contentOptions').appendChild(divAlert);
    }
}

function showDescricao(idDescricao, event) {
    alertify.alert('Descrição do Adicional', descricoes[idDescricao]);
    event.stopPropagation();
    event.preventDefault();
}

function findLists(produtoId) {
    findListsReal("../listas/getListas/" + parseInt(produtoId), produtoId);
}

function findListsAdmin(produtoId) {
    findListsReal("../../listas/getListas/" + parseInt(produtoId), produtoId);
}

function findListsReal(url, produtoId) {
    var content = document.getElementById("contentOptions");
    while (content.firstChild) {
        content.removeChild(content.firstChild);
    }
    jQuery.ajax({
        url: url,
        method: "GET",
        async: false,
        dataType: "json",
        success: function (data) {
            montaListasAdicionais(data);
        },
        error: function (data) {
            var divAlert = document.createElement('div');
            divAlert.setAttribute('class', 'alert alert-danger');
            var icon = document.createElement('i');
            icon.setAttribute('class', 'far fa-grin-beam-sweat fa-3x');
            divAlert.appendChild(icon);
            var span = document.createElement('span');
            span.textContent = 'Não sei como dizer isso mas não foi possível carregar as opções para este produto!';
            divAlert.appendChild(span);
            document.getElementById('contentOptions').appendChild(divAlert);
        }
    });
}

function verificaQuantidadeIsInt(event) {
    if (event.keyCode == 8){
        return;
    }
    var valor = $("#quantidadeProduto").val();
    var invalid = false;
    if(valor == "" || valor <= 0){
        invalid = true;
        valor = 1;
    }
    $("#quantidadeProduto").val(parseInt(valor));
    if(invalid){
        alertify.alert('Atenção!','Informe um valor maior que zero para o campo quantidade do produto');
    }
    readequaValorProduto();
}

function readequaValorProduto() {
    var selects = ($("select"));
    var valorAdicional = 0;
    var valorProduto = $("#precoProdutoOriginal").val();
    for (var i = 0; i < selects.length; i++) {
        var selectedOptions = $("option:selected", selects[i]);
        for (var j = 0; j < selectedOptions.length; j++) {
            var valorAdicionalAtual = $(selectedOptions[j]).attr('valoradicional');
            valorAdicional = (parseFloat(valorAdicional) + parseFloat(valorAdicionalAtual));
        }
    }
    $("#precoProduto").val((parseFloat(valorAdicional) + parseFloat(valorProduto)) * parseInt($("#quantidadeProduto").val()));
}

function montaDataPedidoItem(userId, pedidoId){
    var quantidade = parseInt($("#quantidadeProduto").val());
    if(quantidade <= 0 || isNaN(quantidade)){
        alertify.alert('Atenção!','Informe um valor maior que zero para o campo quantidade do produto');
        return;
    }
    var data = {};
    if(userId){
        data.userId = userId;
    }
    if(pedidoId){
        data.pedidoId = pedidoId;
    }
    data.idProduto = $("#idProduto").val();
    data.quantidade = $("#quantidadeProduto").val();
    data.observacao = $("#observacaoDigitada").val();
    data.opcionais = [];
    if ($("select")) {
        var selects = ($("select"));
        for (var i = 0; i < selects.length; i++) {
            var idLista = $(selects[i]).attr('id');
            var optionsSelected = $("option:selected", selects[i]);
            for (var j = 0; j < optionsSelected.length; j++) {
                data.opcionais.push({'opcional': $(optionsSelected[j]).attr('idopcional'), 'lista': idLista});
            }
        }
    }
    return data;
}

function addItemToCart(userId) {
    var success = verificaMinimoOpcoes();
    if(success){
        var data = montaDataPedidoItem(userId, false);
        enviteToCart(data);
    }
}

function addItemToPedido(pedidoId) {
    var success = verificaMinimoOpcoes();
    if(success){
        var data = montaDataPedidoItem(false, pedidoId);
        enviteToPedido(data);
    }
}


function verificaMinimoOpcoes() {
    var selects = $('select');
    try{
        selects.each(certificaMinimoPreechido);
        return true;
    }catch (e) {
        return false;
    }

}

function certificaMinimoPreechido(index, element) {
    var minOptions = $(element).attr('data-min-options');
    var title = $(element).attr('titleLista');
    var selecteds = $('option:selected', element);
    if(minOptions == 0){
        return true;
    }else if(selecteds.length < minOptions){
        var opcao = 'opção';
        if(minOptions > 1){
            opcao = 'opções';
        }
        alertify.alert('Atenção!','A lista: '+title+', precisa que você selecione ao menos '+minOptions+' '+opcao);
        $("#opcoesTabModal").click();
        throw new Error('A lista: '+title+' precisa que selecione ao menos '+minOptions+' opções');
    }
}

function enviteToCart(data) {
    $(".div-ajax-invite-cart").show();
    jQuery.ajax({
        url: "../itens-carrinhos/addProduto/",
        method: "GET",
        data: {postProduto: JSON.stringify(data)},
        async: false,
        dataType: "json",
        success: function (data) {
            $(".div-ajax-invite-cart").hide();
            if (data.itemGravado) {
                alertify.success('Item adicionado ao carrinho');
                //Atualiza icone de carrinho;
                var icone = $(".icon-cart-number");
                var valorAtual = parseInt(icone.html());
                icone.html(valorAtual + 1);
                closeModal();
            } else {
                alertify.error('Não foi possivel adicionar o item ao carrinho');
            }
        },
        error: function (data) {
            $(".div-ajax-invite-cart").hide();
            alertify.error('Não foi possivel adicionar o item ao carrinho');
        }
    });
    $(".div-ajax-invite-cart").hide();
}

function enviteToPedido(data) {
    jQuery.ajax({
        url: "../../pedidos-produtos/addPedidoItem/",
        method: "GET",
        data: {postProduto: JSON.stringify(data)},
        async: false,
        dataType: "json",
        success: function (data) {
            if (data.itemGravado) {
                alertify.success('Item adicionado ao carrinho');
                //Atualiza icone de carrinho;
                var icone = $(".icon-cart-number");
                var valorAtual = parseInt(icone.html());
                icone.html(valorAtual + 1);
                closeModal();
            } else {
                alertify.error('Não foi possivel adicionar o item ao carrinho');
            }
        },
        error: function (data) {
            alertify.error('Não foi possivel adicionar o item ao carrinho');
        }
    });
}

function openModal() {
    $('#openModal').click();
    $('#initialTabModal').click();
}

function closeModal() {
    $("#quantidadeProduto").val(1);
    $('#closeModal').click();
}
