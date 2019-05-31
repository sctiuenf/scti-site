<?php
require_once __DIR__.'/Connection.php';

function db_query($query, ...$params){
    
    $pdo = Connection::getInstance();
    
    $stmt = $pdo->prepare($query);
    foreach($params as $i => $param)
        $stmt->bindValue($i+1, $param);
    
    $stmt->execute();
    return $stmt;
}
function db_select($query, ...$params){

    $stmt = db_query($query, ...$params);

    $rows = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        array_push($rows, $row);

    return count($rows) > 0 ? $rows:null;
}
function sanitize($str){
    $str = trim(htmlspecialchars(strip_tags($str)));
    return strlen($str) > 0 ? $str:null;
}

function getLastInsertId(){
    $pdo = Connection::getInstance();
    return $pdo->lastInsertId();
}

function pretty_print($var){
    highlight_string("<?php\n" . var_export($var, true) . ";\n?>");
}
?>