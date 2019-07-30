<?php 
header('Content-Type: application/json');
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/config/eventDate.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/models/Event.php';
require_once $root_dir_path.'/models/User.php';
require_once $root_dir_path.'/utils/json_utils.php';

session_start();

try{
    if(!isset($_SESSION['logged']) || !isset($_SESSION['user'])){
        header('Location: '.$root_url);
        die;
    }

    $user = unserialize($_SESSION['user']);

    if($user->getPaymentStatus() !== 'A')
        json_return(false, 'Você ainda não completou o pagamento da sua inscrição.');

    date_default_timezone_set("America/Sao_Paulo");
    //prazo final para escolha de camisa = último dia de inscrições (1 semana antes do evento)
    if(time() > strtotime(SHIRT_END))
        json_return(false, 'O período para escolha de camisa foi encerrado.');

    if(!isset($_POST['shirt']) || !isset($_POST['shirt-size']))
        json_return(false, 'Dados não recebidos');



    $result = $user->chooseShirt($_POST['shirt'], $_POST['shirt-size']);
    
    if($result == 'notExist')
        json_return(false, 'Camisa não existente');

    json_return(true, $result);

}catch(Exception $e){
    json_return(false, $e->getMessage(), $e);
}
?>