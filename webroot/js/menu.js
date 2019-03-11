$(document).ready(function () {
    var lis = $(".collapsed");
    lis.each(onClickSaveLastSistem);
    if(sessionStorage.getItem("sistemaSelecionado")){
        var clickable = $(document).find('[data-target="'+sessionStorage.getItem("sistemaSelecionado")+'"]');
        clickable.click();
    }
    $("select").select2({
        minimumInputLength: 0
    });
});

function onClickSaveLastSistem(index, element) {
    $(element).click(function() {
        sessionStorage.setItem("sistemaSelecionado", $(element).attr('data-target'));
    });
}

function closeMenu() {
    //Esta fechado entao vamos abrir
    if($(".nav-side-menu").width() < 300){
        $(".brand").show();
        $(".menu-content").show();
        $(".nav-side-menu").width('300px');
        $(".content-next-menu").css('margin-left', '300px');

    //Esta aberto entao vamos fechar
    }else{
        $(".brand").hide();
        $(".menu-content").hide();
        $(".nav-side-menu").width('58px');
        $(".content-next-menu").css('margin-left', '58px');
    }
}