<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/views/partials/header.php';

if(isset($_SESSION['logged'])){
    header('Location: '.$root_url.'/user/account');
    die;
}
?> 
    <link rel="stylesheet" type="text/css" href="<?=$root_url?>/assets/css/access.css">
    <main class="access-main row container-fluid h-100 justify-content-center align-items-center m-0">
    <div class="access-card login-card justify-content-center align-items-center">
        <h1 class="mb-4 light-color access-card-title">Login</h1>
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-sm-11">
                <form class="w-100" id="authenticate" method="post">
                    <?php if(isset($_GET['passReseted']) && $_GET['passReseted']) { ?>

                    <div class="alert alert-success" role="alert">
                    Senha alterada com sucesso!
                    </div>

                    <?php } ?>
                    <div class="form-group mb-5">
                        <input id="signin-email" class="form-control" required name="email" type="email">
                        <label class="label-float" for="signin-email">Email</label>
                    </div>
                    <div class="form-group m-0">
                        <input id="signin-password" class="form-control" required name="password" type="password">
                        <label class="label-float" for="signin-password">Senha</label>
                    </div>

                    <div class="access-btns-container d-flex justify-content-between mt-4">
                        <div class="d-flex access-btns">
                            <input class="btn btn-3d-primary" type="submit" value="Entrar">
                            <button id="show-register-card" type="button" class="btn btn-3d-secondary">Cadastrar</button>
                        </div>

                        <div class="forgot-btn">
                            <a id="show-forgot-card" class="light-color" href="#">Esqueci minha senha</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="access-card register-card justify-content-center align-items-center">
        <h1 class="mb-4 light-color access-card-title">Cadastro</h1>
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-sm-11">
            <form class="w-100" id="create" method="post">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <input id="firstname" class="form-control" required name="firstname" type="text" >
                            <label class="label-float" for="firstname">Nome</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <input id="lastname" class="form-control" required name="lastname" type="text">
                            <label class="label-float" for="lastname">Sobrenome</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input id="signup-email" class="form-control" required name="email" type="email">
                    <label class="label-float" for="signup-email">Email</label>
                </div>
                <div class="form-group">
                    <input id="phone" class="form-control" maxlength="16" name="phone" type="tel" pattern="[\(][0-9]{2}[\)] [0-9]{1} [0-9]{4}[\-][0-9]{4}">
                    <label class="label-float" for="phone" >Telefone</label>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <input id="signup-password" class="form-control" required name="password" type="password">
                            <label class="label-float" for="signup-password">Senha</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <input id="confirm-password" class="form-control" required name="passwordConfirm" type="password">
                            <label class="label-float" for="confirm-password">Confirmar senha</label>
                        </div>
                    </div>
                </div>
                <div class="register-btns d-flex">
                    <input class="btn btn-3d-primary" type="submit" value="Confirmar">
                    <button type="button" class="show-login-card btn btn-3d-secondary ml-3">Voltar</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="access-card forgot-card justify-content-center align-items-center">
        <h1 class="mb-4 light-color access-card-title">Esqueci minha senha</h1>
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-sm-11">
                <form id="setupForgotPass" method="post">  
                    <div class="form-group">
                        <input required class="form-control" type="email" name="email" id="forgot-email">
                        <label for="forgot-email" class="label-float">Email</label>
                    </div>
                    <div class="form-group">        
                        <input class="btn btn-3d-primary" type="submit">
                        <button type="button" class="show-login-card btn btn-3d-secondary ml-3">Voltar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </main>

<?php require_once $root_dir_path.'/views/partials/footer.php' ?>