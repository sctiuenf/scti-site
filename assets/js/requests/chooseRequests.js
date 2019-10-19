$(document).ready(function () {

    //chooseCourses
    $('form#chooseCourses').submit(function(e){
        e.preventDefault();
        console.log('aaa');
        let form = $(this);

        form[0].checkValidity();
        form[0].reportValidity();

        showLoader();
        $.ajax({
            type: "post",
            url: "chooseCourses",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                hideLoader();
                if(response['success']){
                    let message = '';
                    response['data_array'].forEach(e => {
                        if(!e.info) return;

                        switch (e.status){
                            case 'alreadyEnrolled':
                                m = `Você já está inscrito no curso: "${e.info['tituloEvento']}".\n`;
                                break;
                            case 'invalidType':
                                m = 'Esse tipo de inscrição não é válido.`\n';
                                break;
                            case 'isFull':
                                m = `O curso: "${e.info['tituloEvento']}" está cheio.\n`;
                                break;
                            case 'success':
                                m = `Sua inscrição no curso: "${e.info['tituloEvento']}" foi realizada com sucesso!\n`;
                                break;
                            default:
                                break;
                        }
                        message += m;
                    });
                    alert(message);
                }else{
                    alert(response['message']);
                }
            },
            error: function(e){
                hideLoader();
                console.log(e);
            }
        });
    });

    //chooseShirt
    $('form#chooseShirt').submit(function(e){
        e.preventDefault();
        
        let form = $(this);

        form[0].checkValidity();
        form[0].reportValidity();

        showLoader();
        $.ajax({
            type: "post",
            url: "chooseShirt",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                hideLoader();
                if(response['success']){
                    alert('Camisa selecionada com sucesso!');
                }
                else
                    alert(response['message']);
            },
            error: function(e){
                hideLoader();
                console.log(e);
            }
        });
    });
});