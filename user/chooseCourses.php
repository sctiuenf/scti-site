<?php 
header('Content-Type: application/json');
require_once __DIR__.'/../utils/root_dir_path.php';
require_once $root_dir_path.'/config/eventDate.php';
require_once $root_dir_path.'/utils/root_url.php';
require_once $root_dir_path.'/models/Event.php';
require_once $root_dir_path.'/models/User.php';
require_once $root_dir_path.'/utils/json_utils.php';


session_start();

if(!isset($_SESSION['logged']) || !isset($_SESSION['user'])){
    header('Location: '.$root_url);
    die;
}

$c1 = array('info'=>null, 'tipo'=>null, 'status'=>null);
$c2 = array('info'=>null, 'tipo'=>null, 'status'=>null);

date_default_timezone_set("America/Sao_Paulo");
//prazo final inscrições 1 semana antes do inicio do evento
if(time() > strtotime(COURSE_END))
    json_return(false, 'O período de inscrições em cursos foi encerrado.');

if(!isset($_POST['course1']) && !isset($_POST['course2']))
    json_return(false, 'Dados não recebidos');

$c1Id = $_POST['course1'];
$c2Id = $_POST['course2'];

$twoCourses = $c1Id != -1 && $c2Id != -1;

if($twoCourses && $c1Id === $c2Id)
    json_return(false, 'Você escolheu dois cursos iguais.');

$user = unserialize($_SESSION['user']);

Event::deleteUnwantedEnrolls($user->getId(), $c1Id, $c2Id);

if($c1Id != -1){
    $c1['info'] = Event::getById($_POST['course1']);
    if(isset($_POST['c1-tipoInscricao']))
        $c1['tipo'] = $_POST['c1-tipoInscricao'];
    else 
        json_return(false, 'Você não escolheu o tipo de inscrição do curso: <br>'.$c1['info']['tituloEvento']);
}
if($c2Id != -1){
    $c2['info'] = Event::getById($_POST['course2']);
    if(isset($_POST['c2-tipoInscricao']))
       $c2['tipo'] = $_POST['c2-tipoInscricao'];
    else 
    json_return(false, 'Você não escolheu o tipo de inscrição do curso: <br>'.$c2['info']['tituloEvento']);
}

if($twoCourses && strtotime($c1['info']['inicioEvento']) === strtotime($c2['info']['inicioEvento']))
    json_return(false, 'Você não pode fazer dois cursos no mesmo horário.');

$isEnrolledc1 = Event::isEnrolled($user->getId(), $c1['info']['idEvento']);
$isEnrolledc2 = Event::isEnrolled($user->getId(), $c2['info']['idEvento']);

Event::deleteUnwantedEnrolls($user->getId(), $c1['info']['idEvento'], $c2['info']['idEvento']);

if($c1Id == -1 && $c2Id == -1)
    json_return(true, 'clear');

if($isEnrolledc1)
    $c1['status'] = 'alreadyEnrolled';

if($isEnrolledc2)
    $c2['status'] = 'alreadyEnrolled';

$courses = array($c1, $c2);
foreach($courses as $i => $course){
    $courseId = $course['info']['idEvento'];
    $status = '';
    if($course['status'] !== 'alreadyEnrolled'){
        $status = Event::enroll($user->getId(), $courseId, $course['tipo']);
        $courses[$i]['status'] = $status;
    }
}

json_return(true, '', null, $courses);
?>