$(document).ready(function () {

    //labels
    $('.form-control').keyup(function(e){
        let elem = $(this);
        let label = elem.siblings('label');
        if(elem.val() !== '') label.addClass('translated-label');
        else label.removeClass ('translated-label');
    });


    //navbar
    let navbar = $('.navbar');
    let banner = $('#banner');
    let changePoint = banner.innerHeight() - navbar.innerHeight();
   
    $(window).scroll(function(e){
        if(banner.length){
        let scrollPos = $(window).scrollTop();
       
            if(scrollPos > changePoint)
                navbar.addClass('gradient');
            else
                navbar.removeClass('gradient');
        }
    });
    
});

function showLoader(){
    document.getElementById('loader').style.display = 'flex';
}
function hideLoader(){
    document.getElementById('loader').style.display = 'none';
}