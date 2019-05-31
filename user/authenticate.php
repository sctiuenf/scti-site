<?php 
header('Content-Type: application/json');

require_once __DIR__.'/../db/db_functions.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../utils/json_utils.php';
try{
    session_start();

    if(!isset($_POST['email'], $_POST['password']))
        throw new Exception('Informações não recebidas.');

    $email = sanitize($_POST['email']);
    $pass = $_POST['password'];

    $user = new User();
    $user->login($email, $pass);

    json_return(true);
}catch(Exception $e){
   
    json_return(false, $e->getMessage(), $e);
}
?>