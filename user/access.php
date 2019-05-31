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

        <h1>Login</h1>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" required name="email" type="email" placeholder="Email">
            </div>
            <div class="form-group">
            <label>Senha</label>
            <input class="form-control" required name="password" type="password" placeholder="Senha">
               
            </div>
            <input class="btn btn-primary" type="submit" value="Entrar">
            <a class="float-right" href="forgotPassword">Esqueci minha senha</a>
        </form>
        
        </div>
    </div>

    <div class="col-6 d-flex justify-content-center align-items-center">
        <div class="row w-75">
        <form class="w-100" id="create" method="post">
        <h1>Cadastro</h1>
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label>Nome</label>
                        <input class="form-control" required name="firstname" type="text" placeholder="Nome">
                    </div>
                    <div class="col-6">
                        <label>Sobrenome</label>
                        <input class="form-control" required name="lastname" type="text" placeholder="Sobrenome">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" required name="email" type="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Telefone</label>
                <input class="form-control" name="phone" type="tel" placeholder="Telefone" pattern="[0-9]{11}">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label>Senha</label>
                        <input class="form-control" required name="password" type="password" placeholder="Senha">
                    </div>
                    <div class="col-6">
                        <label>Confirmar senha</label>
                        <input class="form-control" required name="passwordConfirm" type="password" placeholder="Nome">
                    </div>
                </div>
            </div>
            
            <input class="btn btn-primary" type="submit" value="Cadastrar">
        </form>
        </div>
    </div>
    </main>

<?php require_once $root_dir_path.'/views/partials/footer.php' ?>