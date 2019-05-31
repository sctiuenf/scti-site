<?php
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/RecoveryToken.php';
require_once __DIR__.'/../utils/json_utils.php';
require_once __DIR__.'/../utils/root_url.php';
require_once __DIR__.'/../utils/mailer.php';

try{
if(!$_POST["email"])
    throw new Exception("Email não enviado");

$email = $_POST["email"];

$user = User::findByEmail($email);
if(!$user)
    throw new Exception('Email não existente');

RecoveryToken::deleteOldTokens($user->getId()); 

$selector = bin2hex(random_bytes(8));
$token = bin2hex(random_bytes(32));
$expires = time() + 3600; //actual timestamp Unix plus 1 hour

$recoveryToken = new RecoveryToken(
    $user->getId(), 
    $selector, 
    password_hash($token, PASSWORD_DEFAULT), 
    $expires
);

$recoveryToken->save(); //save to database

$url = $root_url.'/user/newPassword?selector='.$selector.'&token='.$token;

//send mail
$subject = 'Recuperação de senha SCTI 2019';
$body = '<h3>Precisa de uma forcinha aí?</h3>
<p>Relaxa que tá tudo ok! É só clicar no link abaixo, escolher uma nova senha e curtir a SCTI :)</p>
<a href="'.$url.'">Escolher nova senha</a>';

sendMail($subject, $body, $email);

json_return(true);

}catch (Exception $e) {
    json_return(false, $e->getMessage(), $e);
}
?>