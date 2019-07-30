<?php 
   
   if(strlen(getenv('DB_HOST') > 0)){
        $DB_HOST = getenv('DB_HOST');
        $DB_NAME = getenv('DB_NAME');
        $DB_USERNAME = getenv('DB_USERNAME');
        $DB_PASSWORD = getenv('DB_PASSWORD');
        $DB_CHARSET = 'utf8';
   }else{
        $url = parse_url(getenv('CLEARDB_DATABASE_URL'));
        $DB_HOST = $url['host'];
        $DB_NAME = substr($url['path'], 1);
        $DB_USERNAME = $url['user'];
        $DB_PASSWORD = $url['pass'];
        $DB_CHARSET = 'utf8';
   }  
?>