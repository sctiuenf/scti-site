<?php
require_once __DIR__.'/../db/db_functions.php';

class Shirt {  

    private function __construct(){} 

    public static function getShirtList(){
        $shirts = db_select('SELECT DISTINCT tituloBrinde, descricaoBrinde, fotoBrinde FROM brindes');

        return $shirts;
    }
}
?>