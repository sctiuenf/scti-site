<?php
require_once __DIR__.'/../db/db_functions.php';

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

    public static function isEnrolled($userId, $eventId){
        $result = db_select('SELECT COUNT(*) as count FROM inscricoes WHERE idParticipante=? AND idMinicurso=?', $userId, $eventId)[0];

        return $result['count'] > 0 ? true:false;
    }

    //e1 = e2 = -1 para se desinscrever de todos os cursos;
    public static function deleteUnwantedEnrolls($userId, $e1, $e2){

        //selecionar idMinicurso e tipoInscrição para aumentar quantidade de vagas depois de deletar inscrições
        $results = db_select('SELECT idMinicurso, tipoInscricao FROM inscricoes  WHERE idParticipante = ? AND (idMinicurso != ? AND idMinicurso != ?)', $userId, $e1, $e2);

        if(!$results) return;

        //deletar inscrições
        db_query('DELETE FROM inscricoes WHERE idParticipante = ? AND (idMinicurso != ? AND idMinicurso != ?)', $userId, $e1, $e2);

        //aumentar número de vagas
        foreach($results as $result){
            if($result['tipoInscricao'] === 'padrao')
                db_query('UPDATE eventos SET vagasOcupadas = vagasOcupadas-1 WHERE idEvento=?', $result['idMinicurso']);
            else if($result['tipoInscricao'] === 'alternativa')
                db_query('UPDATE eventos SET vagasAlterOcupadas = vagasAlterOcupadas-1 WHERE idEvento=?', $result['idMinicurso']);
        }
    }

    public static function enroll($userId, $eventId, $type){
            
        $free = false;
        if($type === 'padrao'){
           $result = db_select('SELECT COUNT(*) as count FROM eventos WHERE idEvento=? AND vagasPadrao-vagasOcupadas > 0', $eventId)[0];

           $free = $result['count'] > 0 ? true:false;
        }else if($type === 'alternativa'){
            $result = db_select('SELECT COUNT(*) as count FROM eventos WHERE idEvento=? AND vagasAlternativas-vagasAlterOcupadas > 0', $eventId)[0];

           $free = $result['count'] > 0 ? true:false;
        }else
            return 'invalidType';

        if(!$free)
            return 'isFull';
        
        $date = date('Y-m-d H:i:s');
        db_query('INSERT INTO inscricoes(idParticipante, idMinicurso, dataInscricao, tipoInscricao) VALUES(?, ?, ?, ?)', $userId, $eventId, $date, $type);

        if($type === 'padrao')
            db_query('UPDATE eventos SET vagasOcupadas = vagasOcupadas+1 WHERE idEvento=?', $eventId);
        else if($type === 'alternativa')
            db_query('UPDATE eventos SET vagasAlterOcupadas = vagasAlterOcupadas+1 WHERE idEvento=?', $eventId);
        
        return 'success';
    }

    public static function getById($eventId){
        return db_select('SELECT * FROM eventos WHERE idEvento=?', $eventId)[0];
    }

    
}
?>