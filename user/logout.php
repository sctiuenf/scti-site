<?php
require_once __DIR__.'/../models/User.php';

session_start();
$user = unserialize($_SESSION['user']);
$user->logout();
session_destroy();

header('Location: http://localhost/scti/');
die;
?>