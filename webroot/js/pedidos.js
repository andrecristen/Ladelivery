$(document).ready(function () {
    //Carrega as os valores dos pedidos
    setInterval(function () {
        jQuery.ajax({
            url: "/pedidos/getNewValues/",
            method: "GET",
            async: false,
            dataType: "json",
            success: function (data) {
                angular.forEach(data, function(value, key) {
                    var lastNovos = $('#novos').html();
                    if(key == "novos"){
                        if (value > lastNovos){
                            alertify.alert('Novo pedido', 'Sua empresa recebeu um novo pedido por favor verifique.');
                        }
                    }
                    console.log($('#'+key));
                    $('#'+key).html(value);
                });
            },
            error:function (data) {

            }
        });
    }, 30 * 1000);
});