<?php 
header('Content-Type: application/json');
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/config/eventDate.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/models/Event.php';
require_once $root_dir_path.'/models/User.php';
require_once $root_dir_path.'/utils/json_utils.php';

session_start();

date_default_timezone_set("America/Sao_Paulo");

if(!isset($_SESSION['logged']) || !isset($_SESSION['user'])){
    header('Location: '.$root_url);
    die;
}

$user = unserialize($_SESSION['user']);

if($user->getPaymentStatus() !== 'A')
    json_return(false, 'Você ainda não completou o pagamento da sua inscrição.');

if(!isset($_POST['courses']))
    json_return(false, 'Os cursos desejados não foram enviados.');

$courses = $_POST['courses'];

$max_courses = Event::defineMaxCourses();

if($courses === 'false'){
    Event::deleteAllEnrolls($user->getId());
    json_return(true, 'clear');
}

if(count($courses) > $max_courses)
    json_return(false, 'Você não pode se inscrever em mais de '.$max_courses.' cursos.');


$horarios = array();
foreach($courses as $i => $course){
    $courses[$i]['info'] = Event::getById($course['id']);

    array_push($horarios, $courses[$i]['info']['inicioEvento']);

    if(!isset($course['tipo']) || ($course['tipo'] !== 'padrao' && $course['tipo'] !== 'alternativa'))
    json_return(false, 'Você não escolheu o tipo de inscrição do curso: <b>'.$course['title'].'</b>');
}

if(count(array_unique($horarios)) < count($horarios))
    json_return(false, 'Você selecionou dois cursos que acontecem no mesmo horário. Por favor, desmarque um deles.');

foreach($courses as $i => $course){
    $courses[$i]['enrolled'] = false;

    $isEnrolled = Event::isEnrolled($user->getId(), $course);
   
    if($isEnrolled) {
        $courses[$i]['enrolled'] = true;
        continue;
    }

    if(Event::isFull($course)){
        $t = $course['tipo'] == 'padrao' ? 'regulares':'alternativas';

        json_return(false, 'Não há mais vagas '.$t.' para o curso <b>'.$course['title'].'</b>');
    }

    if(!Event::checkEventDate($course['id'])){
        json_return(false, 'O período de inscrição/desinscrição para o curso <b>'.$course['title'].'</b> foi finalizado.');
    }
}

foreach($courses as $i => $course){
    $courses[$i]['status'] = 'ignore';

    if($course['enrolled']) continue;

    $result = Event::enroll($user->getId(), $course['id'], $course['tipo']);

    if(!$result) json_return('Falha ao fazer inscrições. Favor entrar em contato com a organização do evento.');

    $courses[$i]['status'] = 'success';
}

Event::deleteUnwantedEnrolls($user->getId(), $courses);

json_return(true, '', null, $courses);
?>