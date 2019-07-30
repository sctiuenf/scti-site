<?php 
    $root_dir_path = $_SERVER['DOCUMENT_ROOT'].'/';
   
    if(strpos($root_dir_path, "xampp") !== false)
        $root_dir_path .= 'scti';
?>