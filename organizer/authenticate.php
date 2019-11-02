<?php
header('Content-Type: application/json');

require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/utils/json_utils.php';
require_once $root_dir_path.'/db/db_functions.php';
require_once $root_dir_path.'/models/Organizer.php';
require_once $root_dir_path.'/models/AuthToken.php';

date_default_timezone_set("America/Sao_Paulo");

$params =  json_decode(file_get_contents('php://input'), true);

try{

if(!isset($params['email']) || !isset($params['password']))
    throw new Exception("Dados não recebidos");

$email = sanitize($params["email"]);
$password = $params['password'];

$organizer = Organizer::authenticate($email, $password);
if(!$organizer)
    throw new Exception('Dados de login incorretos');

AuthToken::deleteOldTokens($organizer->getId()); 

$selector = bin2hex(random_bytes(8)).$organizer->getId(); //unique selector
$token = bin2hex(random_bytes(32));
$expires = time() + 1209600; //actual timestamp Unix plus 14 days

$authToken = new AuthToken(
    $organizer->getId(),
    $selector,
    $token,
    $expires
);

$result = $authToken->save();

if(!$result) throw new Exception('Falha ao salvar token na base de dados');

json_return(true, "Autenticato com sucesso", null, array(
    "organizer" => $organizer->getInfo(),
    "selector" => $selector,
    "token" => $token
));
die;

}catch (Exception $e) {
    json_return(false, $e->getMessage(), $e);
}
?>