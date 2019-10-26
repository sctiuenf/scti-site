<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/db/db_functions.php';
require_once $root_dir_path.'/models/Event.php';
require_once $root_dir_path.'/utils/json_utils.php';
require_once $root_dir_path.'/models/Organizer.php';
require_once $root_dir_path.'/models/AuthToken.php';

try{

    if(!Organizer::verifyToken()) throw new Exception('Token de autenticação inválido');

    $selector = AuthToken::getTokenObject()['selector'];

    $organizer_id = Organizer::findByToken($selector)->getId();

    $params =  json_decode(file_get_contents('php://input'), true);

    if(!isset($params['eventId']) || !isset($params['userId']))
        throw new Exception("Dados não recebidos");

    $event_id = $params['eventId'];
    $user_id = $params['userId'];
    $force_checkin = isset($params['force_checkin']) ? $params['force_checkin']:false;

    Event::checkin($event_id, $user_id, $organizer_id, $force_checkin);
    
    json_return(true);

}catch(Exception $e){

    $message = $e->getMessage();
    
    if(isset($e->errorInfo) && $e->errorInfo[1] == 1062) $message = 'O check-in deste usuário já foi feito neste minicurso';

    json_return(false, $message, $e);
}
?>