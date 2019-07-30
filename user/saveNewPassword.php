<?php 
header('Content-Type: application/json');
require_once __DIR__.'/../models/RecoveryToken.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../utils/json_utils.php';
try{
    session_start();

    if(isset($_POST['selector'], $_POST['token'], $_POST['password'], $_POST['passwordConfirm'])){
       
        $pass = $_POST['password'];
        $passConfirm = $_POST['passwordConfirm'];
        $selector = $_POST['selector'];
        $token = $_POST['token'];
        
        $result = RecoveryToken::verifyToken($selector, $token);

        if(!$result)
            throw new Exception('Token inválido.');

        $user = User::findByToken($selector);
        if($user === null)
            throw new Exception('Não existe um usuário associado a este token.');

        $user->changePassword($pass, $passConfirm);

        RecoveryToken::deleteOldTokens($user->getId());

        json_return(true);
    }else
        throw new Exception('Informações não recebidas');

}catch(Exception $e){
    json_return(false, $e->getMessage(), $e);
}
?>