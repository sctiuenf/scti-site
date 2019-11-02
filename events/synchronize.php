<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/db/db_functions.php';
require_once $root_dir_path.'/models/Event.php';
require_once $root_dir_path.'/models/User.php';
require_once $root_dir_path.'/utils/json_utils.php';
require_once $root_dir_path.'/models/Organizer.php';
require_once $root_dir_path.'/models/AuthToken.php';

try{

    if(!Organizer::verifyToken()) throw new Exception('Token de autenticação inválido');

    $events = Event::getUpcomingEvents();
    $attendees = User::getConfirmedUsers();
    
    $response_data = array(
        "events" => $events,
        "attendees" => $attendees
    );

    json_return(true, '', null, $response_data);

}catch(Exception $e){

    json_return(false, $e->getMessage(), $e);
}
?>