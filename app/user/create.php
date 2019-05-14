<?php 
require_once __DIR__.'/../db/db_functions.php';

try{
    if(!isset($_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['password']))
        throw new Exception('Informações não recebidas');
    
    $phone = strlen($_POST['phone']) > 0 ? $_POST['phone']:null;
    
    $params = array($_POST['firstname'], $_POST['lastname'], $phone, $_POST['email']);

    $params = array_map('sanitize', $params);
    array_push($params, password_hash($_POST['password'], PASSWORD_DEFAULT));

    db_query('INSERT INTO participantes(nomeParticipante, sobrenomeParticipante, telefoneParticipante, emailParticipante, senhaParticipante) VALUES(?, ?, ?, ?, ?)', ...$params);

    header('Location: http://localhost/scti/');
    die;
}catch(Exception $e){
    echo 'Erro: ' . $e->getMessage();
    die;
}
?>