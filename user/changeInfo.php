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


 

    $unfilteredParams = array(
        'nomeParticipante' => isset($_POST['firstname']) ? $_POST['firstname']:null, 
        'sobrenomeParticipante' => isset($_POST['lastname']) ? $_POST['lastname']:null, 
        'telefoneParticipante' => isset($_POST['phone']) ? $_POST['phone']:null,
        'emailParticipante' => isset($_POST['email']) ? $_POST['email']:null,
        'participarCampeonato' =>  $_POST['championship']
    );
    

    $params = array();
  
    foreach($unfilteredParams as $i => $param){

        if($param !== null){
            $param = sanitize($param);
            if($i == 'telefoneParticipante' || strlen($param) > 0)
                $params[$i] = $param;
        }
    }
    $params['participarCampeonato'] = $_POST['championship'] == "true" ? true:false;

    if(count($params) <= 0)
        throw new Exception('Informações não recebidas');

    $user = unserialize($_SESSION['user']);
    
    $user->changeInfo($params);
    $_SESSION['user'] = serialize($user);

    json_return(true);

}catch(Exception $e){
    json_return(false, $e->getMessage(), $e);
}