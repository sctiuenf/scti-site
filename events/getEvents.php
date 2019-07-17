<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once __DIR__.'/../db/db_functions.php';
require_once __DIR__.'/../models/Event.php';
require_once __DIR__.'/../utils/json_utils.php';

if(!isset($_POST['day']))
    json_return(false, 'Dia não definido.');

$day = (int) $_POST['day'];

if(!($day >= 4 && $day <= 9))
    json_return(false, 'Não há programação para esse dia');


$events = Event::getEventsByDay($_POST['day']);
json_return(true, '', null, $events);

?>