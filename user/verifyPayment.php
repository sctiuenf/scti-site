<?php 
header('Content-Type: application/json');

require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/root_url.php';

session_start();
if(!isset($_SESSION['logged'])){
    header('Location: '.$root_url);
    die;
}

require_once $root_dir_path.'/db/db_functions.php';
require_once $root_dir_path.'/config/sympla.php';
require_once $root_dir_path.'/models/User.php';
require_once $root_dir_path.'/utils/json_utils.php';

try{
    date_default_timezone_set("America/Sao_Paulo");

    if(!isset($_POST['codigoPedido']) || !strlen($_POST['codigoPedido']) > 0)
        json_return(false, 'Código não recebido');

    $codigo = sanitize($_POST['codigoPedido']);
    $user = unserialize($_SESSION['user']);

    if($user->hasPayment() && $user->getPaymentStatus() == 'A')
        json_return(false, 'Sua inscrição já foi realizada');

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://api.sympla.com.br/public/v3/events/'.$EVENT_ID.'/'.'orders/'.$codigo,
        CURLOPT_HTTPHEADER => ['S_TOKEN: '.$API_KEY]
    ]);
    $result = curl_exec($curl);
    
    $data = json_decode($result)->data;
   
    if(!isset($data->id))
        json_return(false, 'Código inválido');
        
    curl_close($curl);

    $id_pagamento =  $data->id;
    $status = $data->order_status;
    /*$data_criacao = strtotime($data->order_date);
    $data_criacao = date('Y-m-d H:i:s', $data_criacao);*/
    $data_criacao = $data->order_date;
    //$data_confirmacao = null;
    $data_confirmacao = $data->updated_date; //alterar a data de confirmação no banco para data de atualização
   

    if(!$user->hasPayment()){
        db_query('INSERT INTO pagamentos(codigoPagamento, statusPagamento, dataCriacao, dataConfirmacao) VALUES(?, ?, ?, ?)', $id_pagamento, $status, $data_criacao, $data_confirmacao);

        
        $last_id = getLastInsertId();
        db_query('UPDATE participantes SET idPagamento=? WHERE idParticipante=?', $last_id, $user->getId());
    }else{
        $registeredCode = $user->getOrderCode();
        if($codigo === $registeredCode){
            db_query('UPDATE pagamentos SET statusPagamento = ?, dataConfirmacao = ? WHERE codigoPagamento = ?', $status, $data_confirmacao, $registeredCode);
        }else{
            db_query('UPDATE pagamentos SET codigoPagamento = ?, statusPagamento = ?, dataCriacao = ?, dataConfirmacao = ? WHERE codigoPagamento = ?', $codigo, $status, $data_criacao, $data_confirmacao, $registeredCode);
        } 
    }

    json_return(true);    
  
}catch(Exception $e){
    json_return(false, $e->getMessage(), $e);
}

?>