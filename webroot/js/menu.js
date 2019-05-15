$(document).ready(function () {
    var lis = $(".collapsed");
    lis.each(onClickSaveLastSistem);
    if(sessionStorage.getItem("sistemaSelecionado")){
        var clickable = $(document).find('[data-target="'+sessionStorage.getItem("sistemaSelecionado")+'"]');
        clickable.click();
    }
});

function onClickSaveLastSistem(index, element) {
    $(element).click(function() {
        sessionStorage.setItem("sistemaSelecionado", $(element).attr('data-target'));
    });
}

function closeMenu() {
    //Esta fechado entao vamos abrir
    if($(".nav-side-menu").width() < 220){
        $(".nav-side-menu").animate({width:"220px"},{queue:false, duration:250});
        $(".content-next-menu").animate({"margin-left":"220px"},{queue:false, duration:250});
        $(".brand").show(10);
        $(".menu-content").show(10);
    //Esta aberto entao vamos fechar
    }else{
        $(".brand").hide(250);
        $(".menu-content").hide(250);
        $(".nav-side-menu").animate({width:"45px"},{queue:false, duration:250});
        $(".content-next-menu").animate({"margin-left":"45px"},{queue:false, duration:250});
    }
}