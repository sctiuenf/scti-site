<?php
require_once __DIR__.'/../db/db_functions.php';
require_once __DIR__.'/../models/AuthToken.php';

class Organizer {  

    private $id, $firstName, $lastName, $email; 

    function __construct($firstName=null, $lastName=null, $email=null){
        $this->id = null;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    } 

    static function findByToken($selector){
        
        $result = db_select('SELECT o.idOrganizador, o.nomeOrganizador, o.sobrenomeOrganizador, o.emailOrganizador from organizadores o INNER JOIN tokensautenticao_organizacao t ON o.idOrganizador=t.idOrganizador WHERE t.selecionador=?', $selector);

        if($result === null)
            return null;

        $attrs = $result[0];
        $organizer = new Organizer($attrs['nomeOrganizador'], $attrs['sobrenomeOrganizador'], $attrs['emailOrganizador']);
        $organizer->id = $attrs['idOrganizador'];

        return $organizer;
    }

    static function authenticate($email, $password){
        $result = db_select('SELECT idOrganizador, nomeOrganizador, sobrenomeOrganizador, emailOrganizador, senhaOrganizador FROM organizadores WHERE emailOrganizador=?', $email);

        if(!$result)
            throw new Exception('Email não encontrado');
        
        $row = $result[0];
        $hashedPass = $row['senhaOrganizador'];
        if(!password_verify($password, $hashedPass))
            throw new Exception('Senha incorreta');
        
        $organizer = new Organizer(
            $row['nomeOrganizador'],
            $row['sobrenomeOrganizador'],
            $row['emailOrganizador']
        );
        $organizer->id = $row['idOrganizador'];
        
        return $organizer;
    }

    static function verifyToken(){
        $tokenObj =  AuthToken::getTokenObject();

        return AuthToken::verifyToken($tokenObj['selector'], $tokenObj['token']);
    }

    public function getId(){return $this->id;}

    public function getInfo(){
        return array(
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "email" => $this->email
        );
    }
}
?>