<?php 
header('Content-Type: application/json');
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/models/Event.php';
require_once $root_dir_path.'/models/User.php';
require_once $root_dir_path.'/utils/json_utils.php';

session_start();

if(!isset($_SESSION['logged']) || !isset($_SESSION['user'])){
    header('Location: '.$root_url);
    die;
}

$user = unserialize($_SESSION['user']);
$enrolls =  $user->getEnrollments();

json_return(true, '', null, $enrolls);
?>