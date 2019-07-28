$(document).ready(function () {

    //authenticate
    $('form#authenticate').submit(function(e){
        e.preventDefault();
        
        let form = $(this);

        form[0].checkValidity();
        form[0].reportValidity();

        $.ajax({
            type: "post",
            url: "authenticate",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                if(response['success'])
                    window.location.reload();
                else
                    alert(response['message']);
            },
            error: function(e){
                console.log(e);
            }
        });
    });

     //create
     $('form#create').submit(function(e){
        e.preventDefault();
        let form = $(this);

        form[0].checkValidity();
        form[0].reportValidity();
        
        $.ajax({
            type: "post",
            url: "create",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                if(response['success'])
                    window.location.reload();
                else
                    alert(response['message']);
            }
        });
    });

    //verifyPayment
    $('form#verifyPayment').submit(function(e){
        e.preventDefault();
        let form = $(this);

        form[0].checkValidity();
        form[0].reportValidity();
        
        $.ajax({
            type: "post",
            url: "verifyPayment",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                if(response['success'])
                    window.location.reload();
                else
                    alert(response['message']);
            },
            error: function(da){
                console.log(da);
            }
        });
    });

     //sendResetPassEmail
     $('form#setupForgotPass').submit(function(e){
        e.preventDefault();
        let form = $(this);

        form[0].checkValidity();
        form[0].reportValidity();
        
        showLoader();
        $.ajax({
            type: "post",
            url: "setupForgotPass",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                hideLoader();
                if(response['success'])
                    alert('Um link para recuperação de senha foi enviado para o email informado. Lembre-se de verificar a caixa de spam :)');
                else
                    alert(response['message']);
            },
            error: function(e){
                hideLoader();
                console.log(e);
            }
        });
    });

    //resetPass
    $('form#saveNewPassword').submit(function(e){
        e.preventDefault();
        let form = $(this);

        form[0].checkValidity();
        form[0].reportValidity();
        
        $.ajax({
            type: "post",
            url: "saveNewPassword",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                if(response['success'])
                    window.location = 'http://localhost/scti/user/access?passReseted=true';
                else
                    alert(response['message']);
            },
            error: function(e){
                console.log(e);
            }
        });
    });
});