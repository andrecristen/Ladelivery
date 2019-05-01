var app = angular.module('web-app', []);
app.directive('uiInputStar', function () {

    var template =
        '<section class=\'rating-widget\'>\n' +
        '    <div class=\'rating-stars\'>\n' +
        '        <ul id=\'stars\'>\n' +
        '            <li class=\'star\' title=\'Já entendi agora :c\' data-value=\'1\'>\n' +
        '                <i class=\'fa fa-star fa-fw\'></i>\n' +
        '            </li>\n' +
        '            <li class=\'star\' title=\'Melhor do que nada não é?\' data-value=\'2\'>\n' +
        '                <i class=\'fa fa-star fa-fw\'></i>\n' +
        '            </li>\n' +
        '            <li class=\'star\' title=\'Eba, nem pior nem melhor...\' data-value=\'3\'>\n' +
        '                <i class=\'fa fa-star fa-fw\'></i>\n' +
        '            </li>\n' +
        '            <li class=\'star\' title=\'Quase lá!\' data-value=\'4\'>\n' +
        '                <i class=\'fa fa-star fa-fw\'></i>\n' +
        '            </li>\n' +
        '            <li class=\'star\' title=\'TOPISSIMO!!!\' data-value=\'5\'>\n' +
        '                <i class=\'fa fa-star fa-fw\'></i>\n' +
        '            </li>\n' +
        '        </ul>\n' +
        '    </div>\n' +
        ' </section>';

    return {
        replace: true,
        restrict: 'E',
        transclude: false,
        list: '=',
        template: template,
        link: function (scope, element, attrs, ctrl, transclude) {
            $('#stars li', element).on('mouseover', function(){
                var onStar = parseInt($(this).data('value'), 10);

                $(this).parent().children('li.star').each(function(e){
                    if (e < onStar) {
                        $(this).addClass('hover');
                    }
                    else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function(){
                $(this).parent().children('li.star').each(function(e){
                    $(this).removeClass('hover');
                });
            });

            $('#stars li', element).on('click', function(){
                var onStar = parseInt($(this).data('value'), 10);
                // The star currently selected
                var stars = $(this).parent().children('li.star');
                $('#nota').val(onStar);
                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }
            });

        }
    }
});