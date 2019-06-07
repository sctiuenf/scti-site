<?php
require_once __DIR__.'/../db/db_functions.php';

class User {  

    private $id, $firstName, $lastName, $phone, $email; 

    function __construct($firstName=null, $lastName=null, $phone=null, $email=null){
        $this->id = null;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
    } 

    static function findByEmail($email){
       
        $result = db_select('SELECT idParticipante, nomeParticipante, sobrenomeParticipante, telefoneParticipante, emailParticipante from participantes WHERE emailParticipante=?', $email);

        if($result === null)
            return null;

        $attrs = $result[0];
        $user = new User($attrs['nomeParticipante'], $attrs['sobrenomeParticipante'], $attrs['telefoneParticipante'], $attrs['emailParticipante']);
        $user->id = $attrs['idParticipante'];

        return $user;
    }

    static function findByToken($selector){
        
        $result = db_select('SELECT p.idParticipante, p.nomeParticipante, p.sobrenomeParticipante, p.telefoneParticipante, p.emailParticipante from participantes p INNER JOIN tokensrecuperacao ON p.idParticipante=tokensrecuperacao.idParticipante WHERE tokensrecuperacao.selecionador=?', $selector);

        if($result === null)
            return null;

        $attrs = $result[0];
        $user = new User($attrs['nomeParticipante'], $attrs['sobrenomeParticipante'], $attrs['telefoneParticipante'], $attrs['emailParticipante']);
        $user->id = $attrs['idParticipante'];

        return $user;
    }

    static function exists($email){
        $result = db_select('SELECT COUNT(*) as count from participantes WHERE emailParticipante=?', $email);

        return $result[0]['count'] > 0 ? true:false;
    }
    
    public function register($password){
       
        db_query('INSERT INTO participantes(nomeParticipante, sobrenomeParticipante, telefoneParticipante, emailParticipante, senhaParticipante) VALUES(?, ?, ?, ?, ?)', $this->firstName, $this->lastName, $this->phone, $this->email, $password);
        
        $this->id = getLastInsertId();

        if(!$this->isLoggedIn()){
            $_SESSION['user'] = serialize($this);
            $_SESSION['logged'] = true;
        }

        return $this;
    }
    public function login($email, $password){
        $result = db_select('SELECT idParticipante, nomeParticipante, sobrenomeParticipante, telefoneParticipante, emailParticipante, senhaParticipante FROM participantes WHERE emailParticipante=?', $email);

        if(!$result)
            throw new Exception('Email não encontrado');
        
        $row = $result[0];
        $hashedPass = $row['senhaParticipante'];
        if(!password_verify($password, $hashedPass))
            throw new Exception('Senha inválida');
        
        $this->id = $row['idParticipante'];
        $this->firstName = $row['nomeParticipante'];
        $this->lastName = $row['sobrenomeParticipante'];
        $this->phone = $row['telefoneParticipante'];
        $this->email = $row['emailParticipante'];

        if(!$this->isLoggedIn()){
            $_SESSION['user'] = serialize($this);
            $_SESSION['logged'] = true;
        }

        return $this;
    }
    public function logout(){
        unset($_SESSION['logged']);
        unset($_SESSION['user']);
    }

    public function isLoggedIn(){
        return isset($_SESSION['user'], $_SESSION['logged']);
    }

    public function changePassword($password, $confirm){
        if(strlen($password) < 6)
            throw new Exception('A senha deve ter no mínimo 6 caracteres.');
    
        if($password !== $confirm)
            throw new Exception('As senhas não são iguais.');

        $hash = password_hash($password, PASSWORD_DEFAULT);

        db_query('UPDATE participantes SET senhaParticipante=? WHERE idParticipante=?', $hash, $this->id);
    }

    public function getName(){return $this->firstName;}

    public function getId(){return $this->id;}

    public function getInfo(){
        return array(
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "phone" => $this->phone,
            "email" => $this->email
        );
    }

    public function HasPayment(){
        if(!$this->isLoggedIn()){
            return false;
            die;
        }

        $result = db_select('SELECT idPagamento FROM participantes WHERE idParticipante=?', $this->id);
        
        if(!$result[0]['idPagamento']){
            return false;
            die;
        }
        return true;
    }

    public function getPaymentStatus(){
        if(!$this->HasPayment()){
            return 'Pagamento não efetuado.';
        }
        $result = db_select('SELECT statusPagamento FROM participantes INNER JOIN pagamentos ON participantes.idPagamento=pagamentos.idPagamento WHERE idParticipante=?', $this->id);
        $status = $result[0]['statusPagamento'];

        
        return $status;
    }

    public function getEnrollments(){
        $enrolls = db_select('SELECT e.tituloEvento, e.inicioEvento, e.fotoEvento, e.preRequisitosOrg, e.preRequisitosTec, e.vagasPadrao, e.vagasAlternativas, e.vagasOcupadas, e.vagasAlterOcupadas, i.idMinicurso FROM inscricoes INNER JOIN eventos ON i.idMinicurso=e.idEvento WHERE i.idParticipante=?', $this->id);

        return $enrolls;
    }

    public function chooseShirt($name, $size){
        $result = db_select('SELECT idBrinde FROM brindes WHERE tituloBrinde = ? AND tamanhoBrinde = ?', $name, $size);

        if(!$result)
            throw new Exception('Camisa não existente');

        $shirtId = $result[0]['idBrinde'];

        $currentShirt = db_select('SELECT idBrinde FROM participantes WHERE idParticipante=?', $this->id)[0]['idBrinde'];

        if($shirtId === $currentShirt)
            throw new Exception('Você já selecionou essa camisa.');

        db_query('UPDATE participantes SET idBrinde=? WHERE idParticipante=?', $shirtId, $this->id);
    }
}
?>