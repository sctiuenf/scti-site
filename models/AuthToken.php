<?php
require_once __DIR__.'/../db/db_functions.php';

class AuthToken {
    private  $organizerId, $selector, $token, $expires;

    function __construct($organizerId, $selector, $token, $expires){
        $this->organizerId = $organizerId;
        $this->selector = $selector;
        $this->token = $token;
        $this->expires = $expires;
    } 

    static function deleteOldTokens($organizerId){
        db_query('DELETE FROM tokensautenticao_organizacao WHERE idOrganizador=?', $organizerId);
    }

    static function verifyToken($selector, $token){
        date_default_timezone_set("America/Sao_Paulo");
        
        $timeStamp = time();

        $result = db_select('SELECT selecionador, token FROM tokensautenticao_organizacao WHERE selecionador=? AND expiracao > ?', $selector, $timeStamp);

        if($result === null)
            return false;

        $tokenHash = $result[0]['token'];

        return password_verify($token, $tokenHash);
    }

    static function getTokenObject(){

        $selector = isset($_SERVER['HTTP_X_AUTH_SELECTOR']) ? $_SERVER['HTTP_X_AUTH_SELECTOR']:false;
        if(!$selector) throw new Exception('Seletor não recebido.');

        $token = isset($_SERVER['HTTP_X_AUTH_TOKEN']) ? $_SERVER['HTTP_X_AUTH_TOKEN']:false;

        if(!$token) throw new Exception('Token de autenticação não recebido');

        return array(
            'selector' => $selector,
            'token' => $token
        );
    }

    public function save(){
        $result = db_query('INSERT INTO tokensautenticao_organizacao(idOrganizador, selecionador, token, expiracao) VALUES(?, ?, ?, ?)', $this->organizerId, $this->selector, password_hash($this->token, PASSWORD_DEFAULT), $this->expires);

        return $result;
    }
}

?>