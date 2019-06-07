<?php 
header('Content-Type: application/json');
require_once __DIR__.'/../models/Event.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../utils/json_utils.php';

session_start();

try{
    if(!isset($_SESSION['logged']) || !isset($_SESSION['user'])){
        header('Location: http://localhost/scti/');
        die;
    }

    date_default_timezone_set("America/Sao_Paulo");
    //prazo final para escolha de camisa = último dia de inscrições (1 semana antes do evento)
    if(time() > strtotime('2019-10-27 23:59:59'))
        throw new Exception('O período para escolha de camisa foi encerrado.');

    if(!isset($_POST['shirt'], $_POST['shirt-size']))
        throw new Exception('Dados não recebidos');

    $user = unserialize($_SESSION['user']);

    $user->chooseShirt($_POST['shirt'], $_POST['shirt-size']);
    
    json_return(true);

}catch(Exception $e){
    json_return(false, $e->getMessage(), $e);
}
?>