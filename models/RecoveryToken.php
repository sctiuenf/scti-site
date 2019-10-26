<?php
require_once __DIR__.'/../db/db_functions.php';

class RecoveryToken {
    private  $userId, $selector, $token, $expires;

    function __construct($userId, $selector, $token, $expires){
        $this->userId = $userId;
        $this->selector = $selector;
        $this->token = $token;
        $this->expires = $expires;
    } 

    static function deleteOldTokens($userId){
        db_query('DELETE FROM tokensrecuperacao WHERE idParticipante=?', $userId);
    }

    static function verifyToken($selector, $token){
        date_default_timezone_set("America/Sao_Paulo");
        $timeStamp = time();

        $result = db_select('SELECT selecionador, token FROM tokensrecuperacao WHERE selecionador=? AND expiracao > ?', $selector, $timeStamp);

        if($result === null)
            return false;

        $tokenHash = $result[0]['token'];

        return password_verify($token, $tokenHash);
    }

    public function save(){
        db_query('INSERT INTO tokensrecuperacao(idParticipante, selecionador, token, expiracao) VALUES(?, ?, ?, ?)', $this->userId, $this->selector, $this->token, $this->expires);
    }
}

?>