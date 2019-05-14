<?php
require_once __DIR__.'/Connection.php';

function db_query($query, ...$params){

    $pdo = Connection::getInstance();
    
    try{
        $stmt = $pdo->prepare($query);
        foreach($params as $i => $param)
            $stmt->bindValue($i+1, $param);
        
        $stmt->execute();
        return $stmt;
    }catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die();
    }
}
function db_select($query, ...$params){

    $stmt = db_query($query, ...$params);

    $rows = array();
    while($row = $stmt->fetch())
        array_push($rows, $row);

    return count($rows) > 0 ? $rows:null;
}
function sanitize($str){
    $str = trim(htmlspecialchars(strip_tags($str)));
    return strlen($str) > 0 ? $str:null;
}

function pretty_print($var){
    highlight_string("<?php\n" . var_export($var, true) . ";\n?>");
}
?>