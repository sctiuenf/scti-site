<?php 
    require_once $root_dir_path.'/utils/root_url.php'; 
    require_once  $root_dir_path.'/models/User.php';
    require_once $root_dir_path.'/utils/json_utils.php';
    session_start();

    //gambiarra pra tirar o scroll do body, prometo que vou ajeitar um dia <3
    
    $page = '';
    if(strpos($_SERVER["PHP_SELF"], 'account')  !== false)
        $page = 'account';
    else if(strpos($_SERVER["PHP_SELF"], 'index')  !== false)
        $page = 'index';

    $paymentComplete = true;
    if($page == 'account'){
        
        if(isset($_SESSION['logged'], $_SESSION['user'])){
            $user = unserialize($_SESSION['user']);

            $paymentComplete = $user->hasPayment() && $user->getPaymentStatus() === 'A';
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>SCTI 2019</title>
        <meta name="title" content="SCTI 2019">
        <meta name="keywords" content="scti, computação, tecnologia, uenf">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="Portuguese">
        <meta name="author" content="Pedro Leal, Diana de Sales, Ian Louzada">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Description" content="Website da Semana Acadêmica de Ciência da Computação e Tecnologia da Informação da Universidade Estadual Darcy Ribeiro - UENF. Saiba mais sobre um dos maiores e melhores eventos de tecnologia da região.">

        <link rel="icon" href="<?=$root_url?>/favicon.ico">

        <link rel="stylesheet" type="text/css" href="<?=$root_url?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=$root_url?>/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?=$root_url?>/assets/css/slick.css">
        <link rel="stylesheet" type="text/css" href="<?=$root_url?>/assets/css/account.css">


        <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree|Open+Sans&display=swap" rel="stylesheet">


        <script src="<?=$root_url?>/assets/js/libs/jquery-3.4.1.min.js"></script>
        <script src="<?=$root_url?>/assets/js/libs/popper.js"></script>
        <script src="<?=$root_url?>/assets/js/libs/bootstrap.min.js"></script>
        <script src="<?=$root_url?>/assets/js/libs/fontawesome.js"></script>
    
    </head>
    <body <?php if(!$paymentComplete) echo 'style="overflow:hidden"'?>>


    <nav class="navbar navbar-expand-lg navbar-dark fixed-top <?php if($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI'] !== '/scti/') echo "gradient"?>">
        <a class="navbar-brand" href="<?=$root_url?>">SCTI</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=$root_url?>">Home <span class="sr-only">(current)</span></a>
                </li>
                
                <?php if($page == 'index'){?>
                <li class="nav-item">
                    <a class="nav-link" tabindex="0" onclick="scrollToDiv('#sec-sobre')">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" tabindex="0" onclick="scrollToDiv('#programacao')">Programação</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" tabindex="0" onclick="scrollToDiv('#patrocinadores-sec')">Patrocinadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" tabindex="0" onclick="scrollToDiv('#sec-contato')">Contato</a>
                </li>
                <?php }?>
                
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
   


    
    