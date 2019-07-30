<?php 
$EVENT_ID = getenv('EVENT_ID');
$API_KEY = getenv('SYMPLA_API_KEY');

$ORDER_STATUS = array(
    'P' => 'pending', //aprovação pendente (cartão crédito) ou pagamento pendente(boleto/débito bancário)
    'A' => 'approved', //pedido aprovado
    'NA' => 'notApproved', //pedido não aprovado (cartão de crédito)
    'NP' => 'notPaid', //pagamento não concluído (boleto bancário/débito online)
    'R' => 'refundRequest', //reembolso solicitado
    'C' => 'cancelled' //pedido reembolsado e cancelado
);
?>