var navbar, banner, btnUp, page;

$(document).ready(function () {
    page = getCurrentPath();

    jWindow = $(window);
    navbar = $('.navbar');
    banner = $('#banner');
    btnUp = $('.btn-up');
    btnDown = $('.scroll-down');

    //verify payment status
    if(page == 'account'){
        updatePaymentStatus();
    }
  
    //labels
    $('.form-control').keyup(function(e){
        let elem = $(this);
        let label = elem.siblings('.label-float');
        if(elem.val() !== '') label.addClass('translated-label');
        else label.removeClass ('translated-label');
    });
    
    //navbarcolor
    navColorAndBtnUp();

    //phone input
    
    let telInput = $('input[type=tel]');
    if(telInput.length){
        let tel = onlyNumber(telInput.val());
        let maskedTell = getMaskedTell(tel);
            
        telInput.val(maskedTell);
    }
    telInput.on('keyup', () => {
        let tel = onlyNumber(telInput.val());
        let maskedTell = getMaskedTell(tel);
        
        telInput.val(maskedTell);
    });

    //click listeners
    btnUp.click(function(e){
        scrollToDiv(0);
    });

    //close alert
    $('.alert .close').click(function(e){
        e.preventDefault();
        hideAlert();
    });


    $('.navbar-toggler').click(function(e){
        if($(this).hasClass('collapsed'))
            navbar.css('background-color', 'rgba(0, 0, 0, 0.6)');
        else
            navbar.css('background-color', 'transparent');
    });

    if(btnDown.length){
        btnDown.click(function(){
            scrollToNextSection();
        });
    }
    $('#verifyPayment-btn').click(function(e){
        $('form#verifyPayment').submit();
    });

    if(page == 'access'){
        let loginCard = $('.login-card');
        let registerCard = $('.register-card');
        let forgotCard = $('.forgot-card');

        //access cards listeners
        $('#show-register-card').click(function(){
            loginCard.hide();
            registerCard.css('display', 'flex');
        });
        $('button.show-login-card').click(function(){
            registerCard.hide();
            forgotCard.hide();
            loginCard.css('display', 'flex');
        });
        $('#show-forgot-card').click(function(e){
            e.preventDefault();
            loginCard.hide();
            forgotCard.css('display', 'flex');
        });
    }

    //onScroll listeners
    if(page !== 'access'){
        jWindow.scroll(function(e){
            let actPos = jWindow.scrollTop();

            highlightNavItem();

            if(banner.length)
                navColorAndBtnUp();
            
            if(btnDown.length){
                let tolerance = 50;
                if(actPos >= $('section').last().offset().top-tolerance){
                    if(btnDown.css('display') != 'none')
                        btnDown.hide();    
                }else{
                    if(btnDown.css('display') == 'none')
                        btnDown.show();
                }               
            }
            
            if($('section').eq(1).length){
                if(actPos > $('section').eq(1).offset().top/2){
                    if(btnUp.css('display') === 'none'){
                        btnUp.css('display', 'flex');
                        btnUp.animate({'opacity': 1}, 100);
                    }
                }else{
                    if(btnUp.css('display') !== 'none'){
                        btnUp.css('display', 'none');
                        btnUp.css('opacity', 0);
                    }
                }
            }
        });
    }

    //contact request
    $('form#contact').submit(function(e){
        e.preventDefault();

        let data = $(this).serialize();
        showLoader();
        $.ajax({
            type: "post",
            url: "utils/contact",
            data,
            dataType: "json",
            success: function (response) {
                hideLoader();

                if(response['success']){
                    showAlert('alert-success', 'Mensagem enviada com sucesso!');

                }else{
                    console.log(response);
                    showAlert('alert-danger', 'Falha ao enviar mensagem. Por favor, entre em contato com a equipe do evento através do email: sctiuenf@gmail.com.');
                }
            },
            error: function(e){
                hideLoader();
                console.log(e);
            }
        });
    });
});

function navColorAndBtnUp(){
   
    let scrollPos = $(window).scrollTop();
    let changePoint = banner.innerHeight() - navbar.innerHeight();

    if(!banner.length || scrollPos > changePoint){

        //remover isso depois, adicionar ao css da página account e separar os css's e js's por página
        if(page == 'account'){
            navbar.removeClass('gradient');
            navbar.css('background-color', 'rgba(0, 0, 0, 0.4)');
            $('footer').removeClass('gradient');
            $('footer').css('background-color', 'rgba(0, 0, 0, .4)');

            $('body').css('background-color', '#155799');

            btnUp.removeClass('gradient');
            btnUp.css('background-color', 'rgba(0, 0, 0, 0.4)');
        }else
            navbar.addClass('gradient');
        
    }
    else{
        navbar.removeClass('gradient');
    }
}

function showLoader(waitBeforeShow, target = 'body'){
   
    if(waitBeforeShow){
        var timeOut = setTimeout(function(){
            $(target).css('position', 'relative');

            let loader = $('#loader');
            let pos = target === 'body' ? 'fixed':'absolute';

            loader.detach().appendTo(target);

            loader.removeClass();
            loader.css('display', 'flex');
            loader.addClass(pos);
        }, waitBeforeShow);

        return timeOut;

    }else{
        $(target).css('position', 'relative');

        let loader = $('#loader');
        let pos = target === 'body' ? 'fixed':'absolute';

        loader.detach().appendTo(target);

        loader.removeClass();
        loader.css('display', 'flex');
        loader.addClass(pos);
    }
}

//se um timeout para executar o loader tiver sido chamado, o mesmo é limpo se a execução houver terminado
function hideLoader(timeOut = null){
    
    if(timeOut)
        clearTimeout(timeOut);
    
    $('#loader').hide();
}

//no parameter to top
function scrollToDiv(id){
    
    let scrollTo = 0;
    if(id !== 0)
        scrollTo = $(id).offset().top;
    
    //$(window).scrollTop(scrollTo);
    $('html, body').animate({scrollTop: scrollTo}, 500, 'swing');
}

function scrollToNextSection(){
    let actPos = $(window).scrollTop();
    let sections = $('section');

    let divToScroll;
    $.each(sections, function (i, section) {
        let sec = $(section);

        //i!==0 para garantir que n seja possível scrollar para a primeira seção
        if(i !== 0 && actPos < sec.offset().top){
            divToScroll = sec;
            return false;
        }
        
    });

    scrollToDiv('#'+divToScroll.attr('id'));
}

function updatePaymentStatus(){
    showLoader(0, '.status');

    $.ajax({
        type: "get",
        url: "updatePayment",
        dataType: "json",
        success: function (response) {
            hideLoader();
            if(response['success']){
                
                let status = response['message'];
                let statusLabel = $('.status-label > div').find('div'),
                    statusText = $('.status-text'),
                    listGroups = $('.list-group-container'),
                    widget = $('.sympla-widget');

                let cls, msg;

                if(status == 'A'){
                    widget.hide();
                    listGroups.show();
                    cls = 'status-ball-green';
                    msg = 'Inscrição realizada';
                }else{
                    listGroups.hide();
                    widget.show();

                    switch(status){
                        case 'P':
                            cls = 'status-ball-yellow';
                            msg = 'Inscrição realizada';
                            break;
                        case 'NA':
                            cls = 'status-ball-orange';
                            msg = 'Pagamento não aprovado';
                            break;
                        case 'NP':
                            cls = 'status-ball-orange';
                            msg = 'Pagamento não concluido';
                            break;
                        case 'R':
                            cls = 'status-ball-orange';
                            msg = 'Reembolso solicitado';
                            break;
                        case 'C':
                            cls = 'status-ball-red';
                            msg = 'Pagamento cancelado';
                            break;
                        default:
                            break;
                    }
                  
                }

                statusLabel.attr('class', cls);
                statusText.html(msg);
            }else{
                //não fazer nada
                console.log(response['message']);
            }
        },
        error: function(e){
            console.log(e);
        }
    });
}

function highlightNavItem(){
    let secId = currentSection().attr('id');

    $('.nav-item').removeClass('active');
    $('#link-to-'+secId).parent().addClass('active');
}