<?php
class Connection {  

    private static $pdo;

    private function __construct() {} 

    public static function getInstance() {  
    if (!isset(self::$pdo)) {  

        include(__DIR__.'/../config/database.php');
       
        $opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);  

        self::$pdo = new PDO("mysql:host=" . $DB_HOST . "; dbname=" . $DB_NAME . "; charset=" . $DB_CHARSET . ";", $DB_USERNAME, $DB_PASSWORD, $opcoes);
        
    }  
        return self::$pdo;  
    }  
}
?>