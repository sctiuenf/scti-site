<?php 
    require_once $root_dir_path.'/utils/root_url.php'; 
    require_once  $root_dir_path.'/models/User.php';
    require_once $root_dir_path.'/utils/json_utils.php';
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SCTI 2019</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="<?=$root_url?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=$root_url?>/assets/css/style.css">
    
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">SCTI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=$root_url?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#programacao">Programação</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php
                if(!isset($_SESSION['logged'])){ 
                ?>
                 <li class="nav-item"><a class="nav-link" href="<?=$root_url?>/user/access">Acessar</a></li>
                <?php }else{ 
                $user = unserialize($_SESSION['user']);    
                ?>
                <li class="nav-item"><a class="nav-link" href="<?=$root_url?>/user/account">Conta</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$root_url?>/user/logout">Sair</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
   


    
    