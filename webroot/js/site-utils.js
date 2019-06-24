$(document).ready(function () {
    $('ul li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut(500);
    });
});