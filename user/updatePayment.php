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

    $user = unserialize($_SESSION['user']);

    if(!$user->hasPayment())
        json_return(false, 'Pedido ainda não realizado');

    $codigo = $user->getOrderCode();    
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://api.sympla.com.br/public/v3/events/'.$EVENT_ID.'/'.'orders/'.$codigo,
        CURLOPT_HTTPHEADER => ['S_TOKEN: '.$API_KEY]
    ]);
    $result = curl_exec($curl);
    
    $data = json_decode($result)->data;
        
    curl_close($curl);

    $updated_date = $data->updated_date;

    $status = $data->order_status;

    if($user->getPaymentStatus() == $status)
        json_return(false, 'Pedido já atualizado');

    if($user->getLastOrderUpdate() == $updated_date)
        $updated_date = date("Y-m-d H:i:s");  

    $id_pagamento =  $data->id;
 

    db_query('UPDATE pagamentos SET statusPagamento = ?, dataConfirmacao = ? WHERE codigoPagamento = ?', $status, $updated_date, $id_pagamento);

    json_return(true, $status);
    
}catch(Exception $e){
    json_return(false, $e->getMessage(), $e);
}

?>