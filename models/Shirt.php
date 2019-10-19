<?php
require_once __DIR__.'/../db/db_functions.php';
require_once __DIR__.'/User.php';
require_once __DIR__.'/../config/eventDate.php';

class Shirt {  

    private function __construct(){} 

    public static function getShirtList(){
        $shirts = db_select('SELECT DISTINCT tituloBrinde, descricaoBrinde, fotoBrinde FROM brindes');

        return $shirts;
    }

    //permite que usuários com pagamento processado antes do dia "shirt_end" mudem de camisa até esse dia
    //já para usuários com pagamento processado após o dia "shirt_end", permite que alterem a camisa até o fim das inscrições (insc_end) 
    public static function checkDate($user){
        date_default_timezone_set("America/Sao_Paulo");

        $shirt_end = strtotime(SHIRT_END);
        $insc_end = strtotime(INSC_END);
        $payment_date = strtotime($user->getPaymentDate());

        $current_date = time();

        if($payment_date < $shirt_end) return $current_date < $shirt_end;
        else if($payment_date < $insc_end) return $current_date < $insc_end;
    }
}
?>