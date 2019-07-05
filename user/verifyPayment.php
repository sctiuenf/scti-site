<?php 
header('Content-Type: application/json');
session_start();
if(!isset($_SESSION['logged'])){
    header('Location: http://localhost/scti/');
    die;
}
require_once __DIR__.'/../db/db_functions.php';
require_once __DIR__.'/../config/eventBrite.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../utils/json_utils.php';

try{
    date_default_timezone_set("America/Sao_Paulo");
    $user = unserialize($_SESSION['user']);
    if($user->hasPayment())
        throw new Exception('Pedido já confirmado');
    
    if(!isset($_POST['codigoPedido']) || !strlen($_POST['codigoPedido']) > 0)
        throw new Exception('Código não recebido');

    $codigo = sanitize($_POST['codigoPedido']);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => "https://www.eventbriteapi.com/v3/orders/".$codigo."/",
        CURLOPT_HTTPHEADER => ['Authorization: Bearer '.API_KEY]
    ]);
    $result = curl_exec($curl);
   
    $data = json_decode($result);
    
    if(isset($data->error))
        throw new Exception('Erro ao buscar o pedido.');
    
    curl_close($curl);

    $id_pagamento =  $data->id;
    $status = $data->status;
    $data_criacao = strtotime($data->created);
    $data_criacao = date('Y-m-d H:i:s', $data_criacao);
    $data_confirmacao = null;

    if($status == 'placed'){
        $data_confirmacao = strtotime($data->changed);
        $data_confirmacao = date('Y-m-d H:i:s', $data_confirmacao);
    }

    db_query('INSERT INTO pagamentos(codigoPagamento, statusPagamento, dataCriacao, dataConfirmacao) VALUES(?, ?, ?, ?)', $id_pagamento, $status, $data_criacao, $data_confirmacao);

    $last_id = getLastInsertId();
    db_query('UPDATE participantes SET idPagamento=? WHERE idParticipante=?', $last_id, $user->getId());

    json_return(true);    
  
}catch(Exception $e){
    json_return(false, $e->getMessage(), $e);
}

?>