<?php
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/models/User.php';

session_start();
$user = unserialize($_SESSION['user']);
$user->logout();
session_destroy();

header('Location: '.$root_url);
die;
?>