<?php 
header('Content-Type: application/json');
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../utils/json_utils.php';
try{
    session_start();

    if(isset($_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['password'], $_POST['passwordConfirm'])){
       
        
        $phone = strlen($_POST['phone']) > 0 ? $_POST['phone']:null;
        
        $pass = $_POST['password'];
        if(strlen($pass) < 6)
            throw new Exception('A senha deve ter no mínimo 6 caracteres.');
        
        if($pass !== $_POST['passwordConfirm'])
            throw new Exception('As senhas não são iguais.');
            

        $params = array($_POST['firstname'], $_POST['lastname'], $phone, $_POST['email']);
        $params = array_map('sanitize', $params);
        
        $user = new User(...$params);
        
        $password_hash = password_hash($pass, PASSWORD_DEFAULT);
        
        $user->register($password_hash);
        json_return(true);
    }else
        throw new Exception('Informações não recebidas');

}catch(Exception $e){
    json_return(false, $e->getMessage(), $e);
}
?>