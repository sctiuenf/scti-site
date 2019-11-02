<?php
require_once __DIR__.'/../db/db_functions.php';
require_once __DIR__.'/../config/eventDate.php';

class Event {  

    private function __construct(){} 

    public static function getEvents($type = null){
        if(!$type)
            $events = db_select('SELECT * FROM eventos e 
            INNER JOIN instrutores i ON e.idInstrutor = i.idInstrutor 
            INNER JOIN redessociais r ON i.idInstrutor = r.idInstrutor
        ORDER BY e.inicioEvento ASC');
        
        else{
            $events = db_select('SELECT * FROM eventos e 
            INNER JOIN instrutores i ON e.idInstrutor = i.idInstrutor 
            INNER JOIN redessociais r ON i.idInstrutor = r.idInstrutor
                WHERE e.tipo = ?
        ORDER BY e.inicioEvento ASC', $type);
        }

        if($events === null)    
            return $events;

        //como a junção com a tabela de redes sociais retorna registros duplicados do mesmo evento, é feita a filtragem dos eventos duplicados, e criado uma coluna "redesSociais" contendo as redes sociais associadas a cada instrutor de evento
        $filteredEvents = array();
        foreach($events as $event){
            $idEvento = $event['idEvento'];
            if(!array_key_exists($idEvento, $filteredEvents)){

                $filteredEvents[$idEvento] = $event;

                $filteredEvents[$idEvento]['redesSociais'] = array(
                    $event['nomeRede'] => $event['url']
                );
            }else{

                $filteredEvents[$idEvento]['redesSociais'][$event['nomeRede']] = $event['url'];
            }
        }

        return array_values($filteredEvents);

    }

    public static function getUpcomingEvents(){
        date_default_timezone_set("America/Sao_Paulo");

        $current_date = date("Y-m-d H:i:s"); 

        $events = db_select('SELECT idEvento, tituloEvento, inicioEvento, fimEvento, tipo FROM eventos WHERE fimEvento > ?', $current_date);
        if($events === null)    
            return $events;

        $event_list = array();
        foreach($events as $event){

            if($event['tipo'] === 'minicurso'){

                $inscricoes = db_select('SELECT i.idMinicurso, i.idParticipante, i.tipoInscricao FROM inscricoes i INNER JOIN participantes p ON i.idParticipante=p.idParticipante WHERE idMinicurso = ?', $event['idEvento']);
        
                $event['inscricoes'] = $inscricoes;
            }

            array_push($event_list, $event);
        }
        return $event_list;
    }

    //registra os checkins enviados, e retorna um array contendendo o "status" de cada checkin, dentre eles:
    /*
        "success" => checkin feito com sucesso,
        "already_sync" => checkin já feito anteriormente,
        "not_enrolled" => participante não inscrito no curso, e opção "force_checkin" não marcada
    */
    public static function checkin($attendances, $organizer_id){
        date_default_timezone_set("America/Sao_Paulo");

        $query = 'INSERT INTO presencas(idParticipante, idEvento, dataPresenca, idOrganizador) VALUES ';
        $counter = 0;

        $params = array();

        $results = array();
        foreach($attendances as $att){
            $event_id = $att['eventId'];
            $user_id = $att['userId'];
            $date = $att['date'];
            $force_checkin = isset($att['force_checkin']) ? $att['force_checkin']:false;

            $result = db_select('SELECT COUNT(*) as count FROM presencas WHERE idParticipante = ? AND idEvento = ?', $user_id, $event_id);
            $already_registered = $result[0]['count'] > 0 ? true:false;

            if($already_registered){
                $att['status'] = 'already_sync';
                array_push($results, $att);
                continue;
            }

            $result = db_select('SELECT tipo FROM eventos WHERE idEvento = ?', $event_id);
            $event_type = $result[0]['tipo'];

            if($event_type !== 'minicurso' || $force_checkin === true){
                if($counter > 0) $query .= ', ';

                $query .= '(?, ?, ?, ?)';
                array_push($params, $user_id, $event_id, $date, $organizer_id);

                $att['status'] = 'success';
                array_push($results, $att);
                $counter++;

            }else if($force_checkin === false){
                $result = db_select('SELECT COUNT(*) as count FROM inscricoes WHERE idParticipante=? AND idMinicurso=?', $user_id, $event_id);

                if($result[0]['count'] == 0){

                    $att['status'] = 'not_enrolled';
                    array_push($results, $att);
                }else{
                    if($counter > 0) $query .= ', ';
                    $query .= '(?, ?, ?, ?)';
                    array_push($params, $user_id, $event_id, $date, $organizer_id);
    
                    $att['status'] = 'success';
                    array_push($results, $att);
                    $counter++;
                }
            }
        }
        
        if($counter > 0){
            $result = db_query($query, ...$params);

            if(!$result) throw new Exception('Falha na query para registrar presenças.');
        }

        return $results;
    }

    public static function getEventsByDay($day, $type = null){

        $date = '2019-11-'.$day;

        if(!$type){
            $events = db_select(
            'SELECT * FROM eventos e 
                LEFT JOIN instrutores i ON e.idInstrutor = i.idInstrutor 
                LEFT JOIN redessociais r ON i.idInstrutor = r.idInstrutor
                    WHERE CAST(e.inicioEvento as DATE) = ?
            ORDER BY e.inicioEvento ASC', 
            $date);
        }else{
            $events = db_select(
            'SELECT * FROM eventos e 
                INNER JOIN instrutores i ON e.idInstrutor = i.idInstrutor 
                LEFT JOIN redessociais r ON i.idInstrutor = r.idInstrutor
                    WHERE CAST(e.inicioEvento as DATE) = ? AND e.tipo = ?
            ORDER BY e.inicioEvento ASC', 
            $date, $type);
        }

        if($events === null)    
            return $events;

        //como a junção com a tabela de redes sociais retorna registros duplicados do mesmo evento, é feita a filtragem dos eventos duplicados, e criado uma coluna "redesSociais" contendo as redes sociais associadas a cada instrutor de evento
        $filteredEvents = array();
        foreach($events as $event){
            $idEvento = $event['idEvento'];
            if(!array_key_exists($idEvento, $filteredEvents)){

                $filteredEvents[$idEvento] = $event;

                $filteredEvents[$idEvento]['redesSociais'] = array(
                    $event['nomeRede'] => $event['url']
                );
            }else{

                $filteredEvents[$idEvento]['redesSociais'][$event['nomeRede']] = $event['url'];
            }
        }

        return array_values($filteredEvents);
    }

    public static function isEnrolled($userId, $course){
        $result = db_select('SELECT COUNT(*) as count FROM inscricoes WHERE idParticipante=? AND idMinicurso=? AND tipoInscricao=?', $userId, $course['id'], $course['tipo'])[0];

        return $result['count'] > 0 ? true:false;
    }

    public static function deleteUnwantedEnrolls($userId, $wantedCourses){

        if(count($wantedCourses) <= 0) return;

        $ids = array();
        $select_query = 'SELECT idMinicurso, tipoInscricao FROM inscricoes  WHERE idParticipante = ?';
        $delete_query = 'DELETE FROM inscricoes WHERE idParticipante = ?';
        foreach($wantedCourses as $course){
            array_push($ids, $course['id'].$course['tipo']);

            $select_query .= ' AND CONCAT(idMinicurso, tipoInscricao) != ?';
            $delete_query .= ' AND CONCAT(idMinicurso, tipoInscricao) != ?';
        }

        //selecionar idMinicurso e tipoInscrição para aumentar quantidade de vagas depois de deletar inscrições
        $results = db_select($select_query, $userId, ...$ids);

        if(!$results) return;

        //deletar inscrições
        db_query($delete_query, $userId, ...$ids);

        //aumentar número de vagas
        foreach($results as $result){
            if($result['tipoInscricao'] === 'padrao')
                db_query('UPDATE eventos SET vagasOcupadas = vagasOcupadas-1 WHERE idEvento=?', $result['idMinicurso']);
            else if($result['tipoInscricao'] === 'alternativa')
                db_query('UPDATE eventos SET vagasAlterOcupadas = vagasAlterOcupadas-1 WHERE idEvento=?', $result['idMinicurso']);
        }
    }
    public static function deleteAllEnrolls($userId){
         //selecionar idMinicurso e tipoInscrição para aumentar quantidade de vagas depois de deletar inscrições
         $results = db_select('SELECT idMinicurso, tipoInscricao FROM inscricoes WHERE idParticipante = ?', $userId);

         if(!$results) return;

         //deletar inscrições e aumentar numero de vagas
         foreach($results as $course){

            db_query('DELETE FROM inscricoes WHERE idParticipante = ? AND (idMinicurso = ? AND tipoInscricao = ?)', $userId, $course['idMinicurso'], $course['tipoInscricao']);

            if($course['tipoInscricao'] === 'padrao'){
                db_query('UPDATE eventos SET vagasOcupadas = vagasOcupadas-1 WHERE idEvento=?', $course['idMinicurso']);
            }else if($course['tipoInscricao'] === 'alternativa'){
                db_query('UPDATE eventos SET vagasAlterOcupadas = vagasAlterOcupadas-1 WHERE idEvento=?', $course['idMinicurso']);
            }
         } 
    }

    public static function isFull($course){
        $isFull = false;

        if($course['tipo'] === 'padrao'){
           $result = db_select('SELECT COUNT(*) as count FROM eventos WHERE idEvento=? AND vagasPadrao-vagasOcupadas > 0', $course['id'])[0];

           $isFull = $result['count'] > 0 ? false:true;
        }else if($course['tipo'] === 'alternativa'){
            $result = db_select('SELECT COUNT(*) as count FROM eventos WHERE idEvento=? AND vagasAlternativas-vagasAlterOcupadas > 0', $course['id'])[0];

           $isFull = $result['count'] > 0 ? false:true;
        }

        return $isFull;
    }

    public static function enroll($userId, $eventId, $type){
        
        $date = date('Y-m-d H:i:s');
        $result = db_query('INSERT INTO inscricoes(idParticipante, idMinicurso, dataInscricao, tipoInscricao) VALUES(?, ?, ?, ?)', $userId, $eventId, $date, $type);

        if(!$result) return false;

        if($type === 'padrao')
            $result = db_query('UPDATE eventos SET vagasOcupadas = vagasOcupadas+1 WHERE idEvento=?', $eventId);
        else if($type === 'alternativa')
            $result = db_query('UPDATE eventos SET vagasAlterOcupadas = vagasAlterOcupadas+1 WHERE idEvento=?', $eventId);

        return true;
    }

    public static function getById($eventId){
        return db_select('SELECT * FROM eventos WHERE idEvento=?', $eventId)[0];
    }

    public static function defineMaxCourses(){
        $max_courses = 2;

        date_default_timezone_set("America/Sao_Paulo");

        $event_start = new DateTime(EVENT_START);
        $current_date = new DateTime('now');

        //gambiarra pra liberação de vaga 1 dia antes do EVENT_START, pois o date diff buga pra esse caso
        if($current_date->format('Y-m-d') === '2019-11-03'){
            $max_courses = $max_courses + 1;
            return $max_courses;
        }

        if($current_date > $event_start){

            $interval = date_diff($event_start, $current_date);
            $interval = intval($interval->format('%r%d'));
            
            $max_courses = $max_courses + $interval + 2;
        }

        return $max_courses;
    }

    public static function checkEventDate($eventId){
        date_default_timezone_set("America/Sao_Paulo");

        //2 hours
        $min_interval = 2;
   
        $result = db_select('SELECT inicioEvento FROM eventos WHERE idEvento=?', $eventId)[0];

        $course_date = new DateTime($result['inicioEvento']);
        $current_date = new DateTime('now');

        $yearDiff = intval($course_date->format('y')) - intval($current_date->format('y'));
        $monthDiff = intval($course_date->format('m')) - intval($current_date->format('m'));
        $dayDiff = intval($course_date->format('d')) - intval($current_date->format('d'));

        if($yearDiff > 0) return true;
        if($monthDiff > 0) return true;
        if($monthDiff == 0 && $dayDiff > 0) return true;

        if($yearDiff == 0 && $monthDiff == 0 && $dayDiff == 0){

            $interval = date_diff($current_date, $course_date);
            $interval = $interval->format("%r%h");

            if(intval($interval) >= $min_interval) return true;
    
            return false;  
        }    
        
        return false;
    }
}
?>