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

    if(!isset($params['attendances']))
        throw new Exception("Dados não recebidos");

    $attendances = $params['attendances'];

    $results = Event::checkin($attendances, $organizer_id);

    json_return(true, 'Sincronização feita com sucesso.', null, $results);

}catch(Exception $e){

    $message = $e->getMessage();
    
    if(isset($e->errorInfo) && $e->errorInfo[1] == 1062) $message = 'Existem checkins já feitos. Nenhum checkin realizado.';

    json_return(false, $message, $e);
}
?>