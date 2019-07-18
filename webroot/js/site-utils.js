$(document).ready(function () {
    $('ul li.dropdown').hover(function() {
        $('.menu-site').stop(true, true).delay(50).fadeIn(500);
    }, function() {
        $('.menu-site').stop(true, true).delay(50).fadeOut(500);
    });
    //A cada 2 minutos carrega as notificacoes
    setInterval(function () {
        jQuery.ajax({
            url: "/logs/countNotificacaoSite/",
            method: "GET",
            async: false,
            dataType: "json",
            success: function (data) {
                if(data.notificacoes){
                    var icone = $(".icon-notify-number");
                    icone.html(data.notificacoes);
                }
            },
            error:function (data) {
                console.log(data);
            }
        });
    }, 120 * 1000);
});