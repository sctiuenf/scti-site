<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/views/partials/header.php';

if(isset($_SESSION['logged'])){
    header('Location: '.$root_url.'/user/account');
    die;
}
?> 
    <main class="row container-fluid h-100">
    <div class="col-6 d-flex justify-content-center align-items-center">
        <div class="row w-75">
        <form class="w-100" id="authenticate" method="post">
            <?php if(isset($_GET['passReseted']) && $_GET['passReseted']) { ?>

            <div class="alert alert-success" role="alert">
            Senha alterada com sucesso!
            </div>

            <?php } ?>
        
        
        <h1 class="mb-4">Login</h1>
            <div class="form-group">
                <input id="signin-email" class="form-control" required name="email" type="email">
                <label for="signin-email">Email</label>
            </div>
            <div class="form-group">
                <input id="signin-password" class="form-control" required name="password" type="password">
                <label for="signin-password">Senha</label>
            </div>
            <input class="btn btn-3d-primary" type="submit" value="Entrar">
            <a class="float-right" href="forgotPassword">Esqueci minha senha</a>
        </form>
        
        </div>
    </div>

    <div class="col-6 d-flex justify-content-center align-items-center">
        <div class="row w-75">
        <form class="w-100" id="create" method="post">
        <h1 class="mb-4">Cadastro</h1>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input id="firstname" class="form-control" required name="firstname" type="text" >
                        <label for="firstname">Nome</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input id="lastname" class="form-control" required name="lastname" type="text">
                        <label for="lastname">Sobrenome</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input id="signup-email" class="form-control" required name="email" type="email">
                <label for="signup-email">Email</label>
            </div>
            <div class="form-group">
                <input id="phone" class="form-control" name="phone" type="tel" pattern="[0-9]{11}">
                <label for="phone">Telefone</label>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input id="signup-password" class="form-control" required name="password" type="password">
                        <label for="signup-password">Senha</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input id="confirm-password" class="form-control" required name="passwordConfirm" type="password">
                        <label for="confirm-password">Confirmar senha</label>
                    </div>
                </div>
            </div>
            
            <input class="btn btn-3d-primary" type="submit" value="Cadastrar">
        </form>
        </div>
    </div>
    </main>

<?php require_once $root_dir_path.'/views/partials/footer.php' ?>