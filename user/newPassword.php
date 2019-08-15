<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/views/partials/header.php';

if(!isset($_GET['selector'], $_GET['token'])){
    header('Location: '.$root_url);
    die;
}
?>

<link rel="stylesheet" type="text/css" href="<?=$root_url?>/assets/css/access.css">

<main class="access-main row container-fluid h-100 justify-content-center align-items-center m-0">
    <div class="access-card login-card justify-content-center align-items-center">
        <h1 class="mb-4 light-color access-card-title">Escolha uma nova senha</h1>
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-sm-11">
                <form id="saveNewPassword" method="post">
                    <input hidden name="selector" type="text" value="<?=$_GET['selector']?>">
                    <input hidden name="token" type="text" value="<?=$_GET['token']?>"> 
                        <div class="form-group">
                            <input required class="form-control" type="password" name="password" id="newPass-password">
                            <label for="newPass-password" class="label-float">Senha</label>
                        </div>
                        <div class="form-group">
                            <input required class="form-control" type="password" name="passwordConfirm" id="newPass-passwordConfirm">
                            <label class="label-float" for="newPass-passwordConfirm">Confirmar senha</label>
                        </div>
                        <div class="form-group">        
                            <input class="btn btn-3d-primary" type="submit">
                        </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require_once $root_dir_path.'/views/partials/footer.php' ?>