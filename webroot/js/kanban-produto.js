$(function () {
    var kanbanCol = $('.panel-body');
    kanbanCol.css('max-height', (window.innerHeight - 150) + 'px');

    var kanbanColCount = parseInt(kanbanCol.length);
    $('.container-fluid').css('min-width', (kanbanColCount * 350) + 'px');

    draggableInit();
});

function draggableInit() {
    var sourceId;

    $('[draggable=true]').bind('dragstart', function (event) {
        sourceId = $(this).parent().attr('id');
        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
    });

    $('.panel-body').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");
            modalProcessando();
            jQuery.ajax({
                url: "../../pedidos-produtos/alterarSituacaoKanban",
                data: {item: elementId , situacao: targetId},
                method: "GET",
                async: false,
                dataType: "json",
                success: function (data) {
                    if(data.success){
                        var element = document.getElementById(elementId);
                        children.prepend(element);
                        alertify.success('Situação alterada');
                    }else{
                        alertify.alert('Error!','Erro ao alterar situação do item, tente novamente.');
                        location.reload();
                    }
                    setTimeout(function () {
                        modalProcessando();
                    }, 1000);
                },
                error: function (data) {
                    alertify.alert('Error!','Erro ao alterar situação do item, tente novamente.');
                    location.reload();
                    setTimeout(function () {
                        modalProcessando();
                    }, 1000);
                }
            });
        }
        event.preventDefault();
    });
}

function modalProcessando() {
    $('#processing-modal').modal('toggle');
}
