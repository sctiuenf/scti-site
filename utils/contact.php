<?php
require_once __DIR__.'/root_dir_path.php'; 
require_once $root_dir_path.'/db/db_functions.php';
require_once $root_dir_path.'/utils/json_utils.php';
require_once $root_dir_path.'/utils/mailer.php';

try{
    if(!isset($_POST['email'], $_POST['firstname'], $_POST['message']))
        json_return(false, 'Dados não recebidos.');

    $tel = '';
    $email = sanitize($_POST['email']);
    $nome = sanitize($_POST['firstname']);
    $mensagem = sanitize($_POST['message']);

    if(isset($_POST['phone']))
        $tel = 'Telefone: '.sanitize($_POST['phone']).'<br>';
    
    $subject = 'Contato SCTI 2019';
    $to = 'sctiuenf@gmail.com';

    $body = "Nome: $nome <br> Email: $email <br> $tel Mensagem: $mensagem";

    sendMail($subject, $body, $to);

    json_return(true);
}catch(Exception $e){
    json_return(false, 'Falha ao enviar mensagem: '.$e->getMessage());
}
?>