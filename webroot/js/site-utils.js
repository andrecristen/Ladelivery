$(document).ready(function () {
    $('ul li.dropdown').hover(function() {
        console.log($('.menu-site'));
        $('.menu-site').stop(true, true).delay(50).fadeIn(500);
    }, function() {
        $('.menu-site').stop(true, true).delay(50).fadeOut(500);
    });
});