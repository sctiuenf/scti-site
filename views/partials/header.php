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
        <link rel="stylesheet" type="text/css" href="<?=$root_url?>/assets/css/slick.css">

        <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree|Open+Sans&display=swap" rel="stylesheet">


        <script src="<?=$root_url?>/assets/js/libs/jquery-3.4.1.min.js"></script>
        <script src="<?=$root_url?>/assets/js/libs/bootstrap.min.js"></script>
        <script src="<?=$root_url?>/assets/js/libs/fontawesome.js"></script>
    
    </head>
    <body>

    <button class="btn btn-up gradient" onclick="scrollToDiv('#banner')"><i class="fas fa-chevron-up"></i></button>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top <?php if($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI'] !== '/scti/') echo "gradient"?>">
        <a class="navbar-brand" href="#">SCTI</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=$root_url?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="scrollToDiv('#programacao')">Programação</a>
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
   


    
    