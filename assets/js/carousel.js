$(document).ready(function () {

    let carousel = $('.scroll-carousel');

    $(window).resize(function(e){
        console.log(carousel.get(0).scrollHeight);
        console.log(carousel.width());
    });
});