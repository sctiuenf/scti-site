$(document).ready(function () {

    //authenticate
    $('form#authenticate').submit(function(e){
        let timeout = showLoader(500);
        e.preventDefault();
        
        let form = $(this);

        form[0].reportValidity();
        if(!form[0].checkValidity()) return false;

        $.ajax({
            type: "post",
            url: "authenticate",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                hideLoader(timeout);
                if(response['success'])
                    window.location.reload();
                else
                    showAlert('alert-danger', response['message']);
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

        form[0].reportValidity();
        if(!form[0].checkValidity()) return false;
        
        $.ajax({
            type: "post",
            url: "create",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                if(response['success'])
                    window.location.reload();
                else
                    showAlert('alert-danger', response['message']);
            }
        });
    });

    //verifyPayment
    $('form#verifyPayment').submit(function(e){
        e.preventDefault();
        let form = $(this);

        form[0].reportValidity();
        if(!form[0].checkValidity()) return false;
        
        showLoader(0);
        $.ajax({
            type: "post",
            url: "verifyPayment",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                hideLoader();
                if(response['success'])
                    window.location.reload();
                else
                    showAlert('alert-danger', response['message']);
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

        form[0].reportValidity();
        if(!form[0].checkValidity()) return false;
        
        showLoader();
        $.ajax({
            type: "post",
            url: "setupForgotPass",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                hideLoader();
                if(response['success'])
                    showAlert('alert-info', 'Um link para recuperação de senha foi enviado para o email informado. Lembre-se de verificar a caixa de spam :)');
                else
                    showAlert('alert-danger', response['message']);
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

        form[0].reportValidity();
        if(!form[0].checkValidity()) return false;
        
        $.ajax({
            type: "post",
            url: "saveNewPassword",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                if(response['success'])
                    window.location = rootUrl() + '/user/access';
                else
                    showAlert('alert-danger', response['message']);
            },
            error: function(e){
                console.log(e);
            }
        });
    });

    //changeInfo
    $('form#changeInfo').submit(function(e){
        let timeOut = showLoader(300, '.info');
        e.preventDefault();
        let form = $(this);

        form[0].reportValidity();
        if(!form[0].checkValidity()) return false;
        console.log(form.serialize());
        $.ajax({
            type: "post",
            url: "changeInfo",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                hideLoader(timeOut);
                if(response['success']){
                    showAlert('alert-success', 'Informações alteradas com sucesso!');
                }else
                    showAlert('alert-danger', response['message']);
            },
            error: function(e){
                console.log(e);
            }
        });
    });

    //changePass
    $('#showModalChangePass').click(function(){
        let modal = $('#changePass-modal');
        modal.find('.btns-confirm').show();
        modal.find('.btn-ok').hide();

        modal.find('.alert-success').hide();
        modal.find('.alert-danger').hide();
        modal.find('.changePassBody').show();
    });
    $('#changePassBtn').click(function(){
        $('form#changePass').trigger('submit');
    });
    $('form#changePass').submit(function(e){
        e.preventDefault();
        let modal = $('#changePass-modal');
        let form = $(this);
        
        form[0].reportValidity();
        if(!form[0].checkValidity()) return false;

        $.ajax({
            type: "post",
            url: 'changePass',
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
               
                if(response['success']){
                    modal.find('.btns-confirm').hide();
                    modal.find('.btn-ok').show();

                    modal.find('.alert-success').show();
                    modal.find('.changePassBody').hide();
                }else{
                    let alert = modal.find('.alert-danger');
                    alert.html(response['message']);
                    alert.show();
                }

                console.log(response);
            }
        });
    });
});