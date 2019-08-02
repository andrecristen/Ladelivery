$(document).ready(function () {
    //Carrega as os valores dos pedidos a cada 45 segundos
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
                            var audio = document.getElementById('alerta');
                            audio.play();
                            alertify.alert('Novo pedido', 'Sua empresa recebeu um novo pedido por favor verifique.');
                        }
                    }
                    $('#'+key).html(value);
                });
            },
            error:function (data) {

            }
        });
    }, 35 * 1000);
});