<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/views/partials/header.php';

if(!isset($_GET['selector'], $_GET['token'])){
    header('Location: http://localhost/scti/');
    die;
}
?>
<main class="row container-fluid justify-content-center align-items-center h-100">
    <form id="saveNewPassword" method="post">
    <input hidden name="selector" type="text" value="<?=$_GET['selector']?>">
    <input hidden name="token" type="text" value="<?=$_GET['token']?>"> 
    <h1>Escolha uma nova senha</h1>
        <div class="form-group">
            <label>Senha</label>
            <input required class="form-control" type="password" name="password">
        </div>
        <div class="form-group">
            <label>Confirmar senha</label>
            <input required class="form-control" type="password" name="passwordConfirm">
        </div>
        <div class="form-group">        
            <input class="btn btn-primary" type="submit">
        </div>
    </form>
</main>
<?php require_once $root_dir_path.'/views/partials/footer.php' ?>