<?php

require_once __DIR__.'/root_dir_path.php'; 
require_once $root_dir_path.'/db/db_functions.php';
require_once $root_dir_path.'/utils/mailer.php';

//Checking if query was built correctly
if(isset($_POST['key']) and isset($_POST['to']) and isset($_POST['body'])and isset($_POST['subject'])){
    if(authenticate($_POST['key'])){
        sendMails($_POST['to'], $_POST['subject'], $_POST['body']);
    } else {
        die("Falha de autenticação");
    }
} else {
    die("Request mal formado");
}

//Function that selects correct people and send them the email
function sendMails($to, $subject, $body){
    $query = 'SELECT nomeParticipante, sobrenomeParticipante, emailParticipante from participantes';

    if($to == 'pending') {
        $query .= ' LEFT JOIN pagamentos ON participantes.idPagamento=pagamentos.idPagamento';
        $query .= " WHERE statusPagamento!='A' OR participantes.idPagamento IS NULL";
    } else if($to == 'confirmed'){
        $query .= ' INNER JOIN pagamentos ON participantes.idPagamento=pagamentos.idPagamento';
        $query .= " WHERE pagamentos.statusPagamento ='A'";
    }

    $recipients = db_select($query);

    $counter = 0;
    if(is_array($recipients))
    foreach($recipients as $recipient){
        $customBody = str_replace('$firstname$', $recipient['nomeParticipante'], $body);
        $customBody = str_replace('$lastname$', $recipient['sobrenomeParticipante'], $customBody);
        sendMail($subject, $customBody, $recipient['emailParticipante']);
        $counter++;
    }
    echo $counter . ' emails enviados.';
}

//Verify authentication key received in the query
function authenticate($key){
    $result = db_select('SELECT * from mailerauth');
    if($result){
        return password_verify($key,  $result[0]['authKey']);
    } else {
        return false;
    }
}

?>