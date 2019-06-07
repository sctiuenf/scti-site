<?php
require_once __DIR__.'/../db/db_functions.php';

class Event {  

    private function __construct(){} 

    public static function getCourseList(){
        $courses = db_select('SELECT idEvento, tituloEvento, inicioEvento, fotoEvento, preRequisitosOrg, preRequisitosTec, vagasPadrao, vagasAlternativas, vagasOcupadas, vagasAlterOcupadas FROM eventos');

        return $courses;
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