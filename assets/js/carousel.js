$(document).ready(function () {
    let scheduleSlider = $('.card-slider');
    scheduleSlider.slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 1500,
        arrows: true,
        dots: false,
        pauseOnHover: false,
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
});

function loadEventSchedule(day, slider){
    $.ajax({
        type: "post",
        url: "events/getEvents",
        data: {day},
        dataType: "json",
        success: function (response) {

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
                    });
                }
            }
           
        }, error: function(e){
            console.log(e);
        }
    });
}
