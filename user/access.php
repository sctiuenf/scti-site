<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/views/partials/header.php';

if(isset($_SESSION['logged'])){
    header('Location: http://localhost/scti/');
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
                <input class="form-control" required name="email" type="email">
                <label>Email</label>
            </div>
            <div class="form-group">
                <input class="form-control" required name="password" type="password">
                <label>Senha</label>
            </div>
            <input class="btn btn-primary" type="submit" value="Entrar">
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
                        <input class="form-control" required name="firstname" type="text" >
                        <label>Nome</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" required name="lastname" type="text">
                        <label>Sobrenome</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" required name="email" type="email">
                <label>Email</label>
            </div>
            <div class="form-group">
                <input class="form-control" name="phone" type="tel" pattern="[0-9]{11}">
                <label>Telefone</label>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" required name="password" type="password">
                        <label>Senha</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" required name="passwordConfirm" type="password">
                        <label>Confirmar senha</label>
                    </div>
                </div>
            </div>
            
            <input class="btn btn-primary" type="submit" value="Cadastrar">
        </form>
        </div>
    </div>
    </main>

<?php require_once $root_dir_path.'/views/partials/footer.php' ?>