$(document).ready(function () {
    allSelectSearch();
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

function allSelectSearch() {
    $('select:not(.select-operador)').selectpicker({
        title: "",
        liveSearch: true,
        width: '100%',
    });
}

function onClickHiddeFilters() {
    var elementShow = $(".icon-show");
    var elementHide = $(".icon-hide");
    elementHide.addClass('icon-show');
    elementHide.removeClass('icon-hide');
    elementShow.addClass('icon-hide');
    elementShow.removeClass('icon-show');
}