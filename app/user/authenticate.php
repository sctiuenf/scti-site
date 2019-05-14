<?php 
require_once __DIR__.'/../db/db_functions.php';

try{
    if(!isset($_POST['email'], $_POST['password']))
        throw new Exception('Informações não recebidas.');

    $email = sanitize($_POST['email']);
    $pass = trim($_POST['password']);

    $result = db_select('SELECT senhaParticipante FROM participantes WHERE emailParticipante=?', $_POST['email']);

    if(!$result)
        throw new Exception('Email não encontrado');
    
    $hashedPass = $result[0]['senhaParticipante'];
    if(!password_verify($pass, $hashedPass))
        throw new Exception('Senha inválida');

    header('Location: http://localhost/scti/');
    die;
}catch(Exception $e){
    echo 'Erro: ' . $e->getMessage();
}
?>