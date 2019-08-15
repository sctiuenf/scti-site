<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/views/partials/header.php';

if(isset($_SESSION['logged'])){
    header('Location: http://localhost/scti/');
    die;
}
?>
<main class="row container-fluid justify-content-center align-items-center h-100">
    <form id="setupForgotPass" method="post">  
    <h1>Recuperar senha</h1>
        <div class="form-group">
            <input required class="form-control mt-4" type="email" name="email" id="email">
            <label class="label-float" for="email">Email</label>
        </div>
        <div class="form-group">        
            <input class="btn btn-3d-primary" type="submit">
        </div>
    </form>
</main>
<?php require_once $root_dir_path.'/views/partials/footer.php' ?>