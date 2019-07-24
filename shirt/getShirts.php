<?php 
require_once __DIR__.'/../utils/root_dir_path.php';
require_once __DIR__.'/../db/db_functions.php';
require_once __DIR__.'/../models/Shirt.php';
require_once __DIR__.'/../utils/json_utils.php';


$shirts = Shirt::getShirtList();
    
json_return(true, '', null, $shirts);

?>