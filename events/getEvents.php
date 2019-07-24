<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once __DIR__.'/../db/db_functions.php';
require_once __DIR__.'/../models/Event.php';
require_once __DIR__.'/../utils/json_utils.php';

$type = isset($_POST['type']) ? $_POST['type']:null;

if(isset($_POST['day'])){

    $day = (int) $_POST['day'];
    if(!($day >= 4 && $day <= 9))
        json_return(false, 'Não há eventos nesse dia');
    
    $events = Event::getEventsByDay($day, $type);
}else{

    $events = Event::getEvents($type);
}
    
json_return(true, '', null, $events);

?>