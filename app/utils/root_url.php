<?php 
if(isset($_SERVER['HTTPS']))
    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
else
    $protocol = 'http';

$root_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
    
if(strpos($root_url, "localhost") !== false)
    $root_url .= "/scti";
?>