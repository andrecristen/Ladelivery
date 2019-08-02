$(document).ready(function () {
    //Carrega as os valores dos pedidos a cada 45 segundos
    setInterval(function () {
        jQuery.ajax({
            url: "/pedidos/getNewValues/true",
            method: "GET",
            async: false,
            dataType: "json",
            success: function (data) {
                var lastNovos = $('#novos-notify').html();
                if (data > lastNovos){
                    var audio = document.getElementById('alerta');
                    audio.play();
                    $('#novos-notify').html(data);
                }
            },
            error:function (data) {

            }
        });
    }, 35 * 1000);
});