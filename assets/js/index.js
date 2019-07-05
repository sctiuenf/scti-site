var navbar, banner, btnUp;

$(document).ready(function () {

    navbar = $('.navbar');
    banner = $('#banner');
    btnUp = $('.btn-up');

    //labels
    $('.form-control').keyup(function(e){
        let elem = $(this);
        let label = elem.siblings('label');
        if(elem.val() !== '') label.addClass('translated-label');
        else label.removeClass ('translated-label');
    });

    navColorAndBtnUp();

    if(banner.length){
        $(window).scroll(function(e){
            navColorAndBtnUp();
        });
    }

    $('.navbar-toggler').click(function(e){
        if($(this).hasClass('collapsed'))
            navbar.css('background-color', 'rgba(0, 0, 0, 0.6)');
        else
            navbar.css('background-color', 'transparent');
    });
});

function navColorAndBtnUp(){
    let scrollPos = $(window).scrollTop();
    let changePoint = banner.innerHeight() - navbar.innerHeight();

    if(scrollPos > changePoint){
        navbar.addClass('gradient');
        btnUp.addClass('disp');
    }
    else{
        navbar.removeClass('gradient');
        //btnUp.css('display', 'none');
    }
}

function showLoader(){
    document.getElementById('loader').style.display = 'flex';
}
function hideLoader(){
    document.getElementById('loader').style.display = 'none';
}
function scrollToDiv(id){
    let scrollTo = $(id).offset().top;
    
    //$(window).scrollTop(scrollTo);
    $('html, body').animate({scrollTop: scrollTo}, 500, 'swing');
}