<?php 

class User{
    public $iduser = null;
    public $name = null;
    public $email = null;

    function __construct($iduser = null){
        if(!is_null($iduser))
            $this->getUser($iduser);
        
    }

    public function getUser($iduser = null){
        $Sql = 'SELECT * FROM users WHERE iduser = :iduser';
        $Db = new Database(DATABASE_ALL_USERS);
        $Statement = $Db->prepare($Sql);
        $Statement->bindValue(':iduser', $iduser);
        $Result = $Statement->execute();
        $Rows = $Statement->fetchAll();

        if($Result && count($Rows) > 0){
            $this->iduser = $Rows[0]['iduser'];
            $this->name = $Rows[0]['name'];
            $this->email = $Rows[0]['email'];

            return $this;
        }
        throw new Exception("Whoops! User não encontrado!");
    }

    public function setSession($keep_logged_in = 0){
        if(is_null($this->iduser))
            throw new Exception("Whoops! User não setado.");
        
        if (!is_writable(session_save_path()))
            Log::doLog('Session path "'.session_save_path().'" is not writable for PHP!', 'session');
            
        session_start();
        foreach(get_object_vars($this) as $Attribute => $value){
            $_SESSION[$Attribute] = $value;
        }

        setcookie('keep_logged_in', $keep_logged_in, time() + 86400); //Expira em 24h
    }

    public function registerUser($Data = []){
        if(!isset($Data['username']) || is_null($Data['username']))
            throw new Exception('Whoops! Insira um nome de usuário.');

        if(!isset($Data['password']) || is_null($Data['password']))
            throw new Exception('Whoops! Insira uma senha.');

        if(!isset($Data['email']) || is_null($Data['email']))
            throw new Exception('Whoops! Insira um email.');
        
        $Sql = 'INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)';
        $Db = new Database(DATABASE_ALL_USERS);
        $Statement = $Db->prepare($Sql);
        $Statement->bindValue(':name', $Data['username']);
        $Statement->bindValue(':email', $Data['email']);
        $Statement->bindValue(':password', $Data['password']);
        $Result = $Statement->execute();

        if($Result)
            return ['status' => 200, 'message' => 'Usuário registrado com sucesso!'];   

        throw new Exception("Whoops! User não encontrado!");
    }

}