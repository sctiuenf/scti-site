var coursePickedAlerts, shirtPickedAlerts;

$(document).ready(function () {
    //enable popovers
    $('[data-toggle="popover"]').popover();

    let page = getCurrentPath();
    selectedCourses = 0, selectedShirts = 0;
    maxCourses = 2, maxShirts = 1;

    let coursesSlider = $('#courses-slider');
    let shirtSlider = $('#shirt-slider');

    $('#confirm-courses').click(function(e){

        let courses = coursesSlider.find('input[type=checkbox]:checked');
    
        let c1Id = courses[0] ? $(courses[0]).val():-1;
        let c2Id = courses[1] ? $(courses[1]).val():-1;

       courseConfirmModal(c1Id, c2Id);
    });

    $('#confirm-shirt').click(function(e){
        let shirtCheckbox = shirtSlider.find('input[type=checkbox]:checked');
        let shirtName = shirtCheckbox.length ? shirtCheckbox.val():-1;
        let shirtSize = shirtName !== -1 ? shirtCheckbox.parent().find('select[name=camisa-tamanho]').val():-1;
      
        shirtConfirmModal(shirtName, shirtSize);
    });

    if(page === ''){

        let scheduleSlider = $('#programacao-slider');
        scheduleSlider.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 1500,
            arrows: true,
            dots: false,
            pauseOnHover: false,
            infinite: false,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1
                }
            }]
        });

        let daySlider = $('.day-slider');
        daySlider.slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 1500,
            arrows: true,
            dots: false,
            pauseOnHover: false,
            infinite: false,
            responsive: [{
                breakpoint: 1350,
                settings: {
                    slidesToShow: 5
                }
            }, {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },{
                breakpoint: 500,
                settings: {
                    slidesToShow: 1
                }
            }]
        });
        
        let date = new Date();
        let dayToLoad = 4; //4 de novembro

        let slidesNumber = daySlider.slick('slickGetOption', 'slidesToShow');
        
        //coloring and sliding to the correct day-circle
        if(date.getMonth()+1 >= 11 && date.getDate() > 4 && slidesNumber !== 6){
            dayToLoad = date.getDate();
            $('.day-circle').removeClass('circle-hovered');
            $('#day-'+date.getDay()).addClass('circle-hovered');
        
            let laterais = slidesNumber%2 == 1 ? Math.floor(slidesNumber/2):(slidesNumber/2) - 1; 

            //-4 pois o primeiro do carrossel tem indíce 0, e o primeiro dia é 4
            daySlider.slick('slickGoTo', date.getDay()-4-laterais);
        }
        
        $('.day-circle').click(function(){
            $('.day-circle').removeClass('circle-hovered');

            let elem = $(this);
            elem.addClass('circle-hovered');

            //pega o dia pelo id do circulo clicado
            let day = elem.attr('id').split('-').pop();
        
            loadEventSchedule(day, scheduleSlider);
        });

        loadEventSchedule(dayToLoad, scheduleSlider);

    }else if(page === 'account'){

        /* load courses slider */
        coursesSlider.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 1500,
            arrows: true,
            dots: false,
            pauseOnHover: false,
            infinite: false,
            responsive: [{
                breakpoint: 1300,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1
                }
            }]
        });

        $.ajax({
            type: 'post',
            url: '../events/getEvents',
            data: {type: 'minicurso'},
            dataType: 'json',
            success: function (response) {
                if(response['success']){

                    let courses = response['data_array'];
              
                    courses.forEach(function(course){
                        
                        let card = getCourseCard(course);
                     
                        coursesSlider.slick('slickAdd', '<div class="slide">'+card+'</div>');
                    });

                    coursePickedAlerts = coursesSlider.find('.picked');

                    //setup requisitos btn
                    $('.btn-requisitos').click(function(){
                        let card = $(this).parent().parent().parent().parent().parent();

                        let reqOrg = card.find('.req-org').html();
                        let reqTec = card.find('.req-tec').html();

                        let modalBody = $('#requisitos-modal').find('.modal-body');
                    
                        modalBody.find('#modal-req-org').html(reqOrg);
                        modalBody.find('#modal-req-tec').html(reqTec);
                    });

                    //inscrições do usuário para selecionar cursos
                    $.ajax({
                        type: "get",
                        url: "getEnrolls",
                        dataType: "json",
                        success: function (response) {
                            if(response['success']){

                                let enrolls = response['data_array'];
                                if(!enrolls)
                                    return;

                                enrolls.forEach(function(enroll){
                                    let checkbox = $(`#evento-${enroll.idMinicurso}`);

                                    checkbox.trigger('click');
                                    checkbox.parent().find('.alert').show();
                                });
                            }else
                                alert(response['message']);
                        },
                        error: function(e){
                            console.log(e);
                        }
                    });
                }
                else{
                    alert(response['message']);
                }
            },  
            error: function (e){
                console.log(e);
            }
        });
        /* /load crouses slider */

        //load shirt slider
        shirtSlider.slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 1500,
            arrows: true,
            dots: false,
            pauseOnHover: false,
            infinite: false,
            responsive: [{
                breakpoint: 1300,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1
                }
            }]
        });

        $.ajax({
            type: 'get',
            url: '../shirt/getShirts',
            dataType: 'json',
            success: function (response) {
                if(response['success']){

                    let shirts = response['data_array'];
               

                    shirts.forEach(function(shirt){
                        
                        let card = getShirtCard(shirt);
                     
                        shirtSlider.slick('slickAdd', '<div class="slide">'+card+'</div>');
                    });
                    shirtPickedAlerts = shirtSlider.find('.picked');

                    //camisa escolhida pelo usuário para selecionar
                    $.ajax({
                        type: "get",
                        url: "getShirt",
                        dataType: "json",
                        success: function (response) {
                            if(response['success']){
                                
                                if(!response['data_array'])
                                    return;

                                let shirt = response['data_array'][0];
                      
                                if(!shirt)
                                    return;

                                let checkbox = $(`.card-checkbox[id='camisa-${shirt.tituloBrinde}']`);

                                checkbox.parent().find('select[name=camisa-tamanho]').val(shirt.tamanhoBrinde);

                                checkbox.trigger('click');
                                checkbox.parent().find('.alert').show();
                                
                            }else
                                alert(response['message']);
                        },
                        error: function(e){
                            console.log(e);
                        }
                    });
                }
                else{
                    alert(response['message']);
                }
            },  
            error: function (e){
                console.log(e);
            }
        });
    }
});

function loadEventSchedule(day, slider){

    let sliderId = slider.attr('id');
    
    let timeOut = showLoader(500);

    $.ajax({
        type: "post",
        url: "events/getEvents",
        data: {day},
        dataType: "json",
        success: function (response) {
        
            hideLoader(timeOut);
     
            if(!response['success'])
                alert(message);
            else{
                slider.slick('slickRemove', null, null, true);

                let events = response['data_array'];
                
                if(!events)
                    slider.slick('slickAdd', '<h3>Não há eventos nesse dia</h3>')
                else{
               
                    events.forEach(function(event){
                       
                        let card = getEventCard(event);
                     
                        slider.slick('slickAdd', '<div class="slide">'+card+'</div>');

                         //activate popovers
                        $('button[data-toggle=popover]').click(function(){
                            $(this).popover('show');
                        });
                    });
                }
            }
           
        }, error: function(e){
            console.log(e);
        }
    });

}

function selectItem(event, type){
    
    let elem = $(event.target);

    let checked = elem.prop('checked');
    let wasChecked = !checked;

    if(wasChecked){
        checkItem(elem);

        if(type == 'minicurso')
            selectedCourses--;
        else if(type == 'camisa')
            selectedShirts--;

    }else{

        if(type == 'minicurso'){
            if(selectedCourses < maxCourses){
                checkItem(elem)
                selectedCourses++;
            }else{
                elem.prop('checked', false);
                alert('Você já escolheu dois cursos.');
            }
        }
        else if(type == 'camisa'){
            if(selectedShirts < maxShirts){
                
                let select = $(elem.parent().find('select[name=camisa-tamanho]'));
              
                if(!select.val()){
                    elem.prop('checked', false);
                    select.trigger('focus');
                }else{
                    checkItem(elem)
                    selectedShirts++;
                }
            }else{
                elem.prop('checked', false);
                alert('Você já escolheu uma camisa.');
            }
        }
    }
   
}

function checkItem(elem){
    
    let overlay = elem.parent().find('.card-overlay');

    if(elem.prop('checked')){
        overlay.show();
        overlay.css('background-color', 'rgba(0, 0, 0, .3)');
    }
    else{
        overlay.hide();
        overlay.css('background-color', 'rgba(0, 0, 0, 0)');
    }
}

function courseConfirmModal(c1Id, c2Id){

    $('#course-confirm-modal .btns-confirm').show();
    $('#course-confirm-modal .btn-ok').hide();

    let courses = [];

    if(c1Id != -1){
        let title = $(`#evento-${c1Id}`).parent().find('#event-tituloEvento').html();
        
        courses.push({title, id: c1Id});
    }
    if(c2Id != -1){
        let title = $(`#evento-${c2Id}`).parent().find('#event-tituloEvento').html();

        courses.push({title, id: c2Id});
    }

    let modalContent = $('#modal-courses');
    modalContent.html('');

    
    if(!courses.length)
        modalContent.append('Tem certeza de que deseja se <b>DESINSCREVER</b> de todos os cursos?');
    else
        modalContent.append('Selecione os tipos de incrição: <br>');
    
    courses.forEach(function(course){
        modalContent.append(`
            ${course.title}<br>
            <label for="padrao">Inscrição Padrão</label><input checked value="padrao" name="c${course.id}-tipo" type="radio" id="padrao">
            <label for="alternativa">Inscrição Alternativa</label><input value="alternativa" name="c${course.id}-tipo" type="radio" id="alternativa"><br><br>
        `);
    });


    $('#confirm-course-btn').off('click');
    $('#confirm-course-btn').click(function(){

       confirmCourses(courses);
    });
}

function confirmCourses(courses){

    courses.forEach(function(course){
        course.tipo = $(`input[name=c${course.id}-tipo]:checked`).val();
    });

    let c1Id = courses[0] ? courses[0].id:-1;
    let c2Id = courses[1] ? courses[1].id:-1;
    let data = {
        course1: c1Id,
        course2: c2Id,
    };
    
    if(c1Id != -1)
        data['c1-tipoInscricao'] = courses[0].tipo;
    if(c2Id != -1)
        data['c2-tipoInscricao'] = courses[1].tipo;

    $.ajax({
        type: "post",
        url: "chooseCourses",
        data,
        dataType: "json",
        success: function (response) {
            $('#course-confirm-modal .btns-confirm').hide();
            $('#course-confirm-modal .btn-ok').show();

            if(response['success']){
                let messages = [];
                coursePickedAlerts.hide();
        
                if(response['message'] === 'clear'){
                    messages.push(`<div class="alert alert-warning">Você se desinscreveu de todos os cursos.</div>`);
                }else{

                    let results = response['data_array'];
                    results.forEach(function(result){
                        if(!result.info)
                            return;

                        let curso = result.info.tituloEvento;
                        switch(result.status){
                            
                            case 'isFull':
                                messages.push(`
                                <div class="alert alert-danger">Não há mais vagas para o curso: "${curso}".</div>`
                                );
                                break;
                            case 'alreadyEnrolled':
                                messages.push(`
                                <div class="alert alert-info">Você já está inscrito no curso: "${curso}".</div>`
                                );
                                break;
                            case 'success':
                                messages.push(`
                                <div class="alert alert-success">Sua inscrição no curso: "${curso}" foi realizada com sucesso!</div>`
                                );
                                break;
                            default:
                                break;
                        }

                        //select the correct course
                        let id = result.info.idEvento;

                        if(result.status === 'success' || result.status === 'alreadyEnrolled'){
                            $(`#evento-${id}`).siblings('.picked').show();
                        }
                    });
                }

                let modalDiv = $('#modal-courses');
                modalDiv.html('');
                messages.forEach(function(message){
                    modalDiv.append(message);
                });
            }
            else{
                let modalDiv = $('#modal-courses');
                modalDiv.html(`<div class="alert alert-danger">${response['message']}</div>`);
            }
        }
    });
}

function shirtConfirmModal(shirtName, shirtSize){

    $('#shirt-confirm-modal .btns-confirm').show();
    $('#shirt-confirm-modal .btn-ok').hide();

    let shirt = {shirt: shirtName};

    if(shirt.shirtName !== -1)
        shirt['shirt-size'] = shirtSize;

    let modalContent = $('#modal-shirt');

    if(shirtName != -1)
        modalContent.html(`Você está escolhendo "<b>${shirtName}</b>" tamanho <b>${shirtSize}</b>`);
    else
        modalContent.html('Tem certeza de que não deseja nenhuma camisa?');

    $('#confirm-shirt-btn').off('click');
    $('#confirm-shirt-btn').click(function(){

       confirmShirt(shirt);
    });
}
function confirmShirt(shirt){
   
    $.ajax({
        type: "post",
        url: "chooseShirt",
        data: shirt,
        dataType: "json",
        success: function (response) {
            $('#shirt-confirm-modal .btns-confirm').hide();
            $('#shirt-confirm-modal .btn-ok').show();
        
            if(response['success']){
                shirtPickedAlerts.hide();
                let modalDiv = $('#modal-shirt');

                let message = '';
              
                switch(response['message']){

                    case 'clear':
                        message = '<div class="alert alert-warning">Sua camisa escolhida foi removida.</div>';
                        break;
                    case 'alreadySelected':
                        message = '<div class="alert alert-info">Você já selecionou essa camisa.</div>';
                        break;
                    case 'success':
                        message = '<div class="alert alert-success">Camisa selecionada com sucesso!</div>';
                        break;
                    default:
                        break;
                }

                modalDiv.html(message);

                if(response['message'] === 'success' || response['message'] === 'alreadySelected'){
                    
                    $('#shirt-slider').find('.card-checkbox:checked').siblings('.picked').show();
                }
            }else{
                $('#modal-shirt').html(`<div class="alert alert-danger">${response['message']}</div>`);
            }
        },
        error: function(e){
            console.log(e);
        }
    });
}



