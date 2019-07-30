<?php 
header('Content-Type: application/json');
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/models/User.php';
require_once $root_dir_path.'/utils/json_utils.php';

try{
    session_start();
    
    if(!isset($_SESSION['logged']) || !isset($_SESSION['user'])){
        header('Location: '.$root_url);
        die;
    }

    if(isset($_POST['currentPass'], $_POST['newPass'], $_POST['newPass-confirm'])){

        $user = unserialize($_SESSION['user']);


        if(!$user->verifyPass($_POST['currentPass']))
            json_return(false, 'Senha atual incorreta');
        
        $user->changePassword($_POST['newPass'], $_POST['newPass-confirm']);

        json_return(true);

    }else
        throw new Exception('Dados não recebidos');

}catch(Exception $e){
    json_return(false, $e->getMessage(), $e);
}