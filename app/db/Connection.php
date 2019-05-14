<?php
require_once __DIR__.'/../../config/database.php';
class Connection {  

    private static $pdo;

    private function __construct() {} 

    public static function getInstance() {  
    if (!isset(self::$pdo)) {  
        try {  
            $opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);  

            self::$pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USERNAME, PASSWORD, $opcoes);
        } catch (PDOException $e) {  
            echo "Falha na conexão: " . $e->getMessage(); 
            die; 
        }  
    }  
        return self::$pdo;  
    }  
}
?>