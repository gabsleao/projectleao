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
            Log::doLog('Session path "'.session_save_path().'" is not writable for PHP!', 'setSession-exception');
        
        if(session_status() == PHP_SESSION_NONE)
            session_start();
        
        foreach(get_object_vars($this) as $Attribute => $value){
            $_SESSION[$Attribute] = $value;
        }

        setcookie('keep_logged_in', $keep_logged_in, time() + 86400); //Expira em 24h
    }

    public function registerUser($Data = []){
        $Sql = 'INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)';
        
        $Db = new Database(DATABASE_ALL_USERS);
        $Statement = $Db->prepare($Sql);
        $Statement->bindValue(':name', $Data['username']);
        $Statement->bindValue(':email', $Data['email']);
        $Statement->bindValue(':password', $Data['password']);
        $Result = $Statement->execute();

        //User inserido no DB, enviar e-mail de boas vindas
        if($Result){
            //envia e-mail de welcome
            Utils::runBackground('sendMail.php', $Data);
        }
        return $Result;
    }

    public function killSession(){
        unset($_SESSION);  
        session_destroy();

        return ['status' => 200, 'message' => 'Usuário deslogado com sucesso!']; 
    }

    public function loginUser($Data = []){
        // $Sql = 'SELECT * FROM users WHERE name = :username AND password  = AES_ENCRYPT("' . ENCRYPT_KEY . '", :password) LIMIT 1';
        $Sql = 'SELECT iduser FROM users WHERE name = :username AND password  = :password';

        $Db = new Database(DATABASE_ALL_USERS);
        $Statement = $Db->prepare($Sql);
        $Statement->bindValue(':username', $Data['username']);
        $Statement->bindValue(':password', $Data['password']);
        $Result = $Statement->execute();
        $Rows = $Statement->fetchAll();

        if($Result && count($Rows) > 0){
            $User = new User($Rows[0]['iduser']);
            
            //set session aqui
            $User->setSession($Data['keep_logged_in']);
            return true;
        }

        return false;
    }

    public function recoverPass($Data = []){
        $Sql = 'SELECT iduser FROM users WHERE email = :email';
        
        $Db = new Database(DATABASE_ALL_USERS);
        $Statement = $Db->prepare($Sql);
        $Statement->bindValue(':email', $Data['email']);
        $Result = $Statement->execute();
        $Rows = $Statement->fetchAll();

        if($Result && count($Rows) > 0){
            //tratar envio de e-mail / recover password
            $User = new User($Rows[0]['iduser']);
            return true;
        }
        return false;
    }

    public function userExistsByEmail($Email = null){
        $Sql = 'SELECT * FROM users WHERE email = :email';

        $Db = new Database(DATABASE_ALL_USERS);
        $Statement = $Db->prepare($Sql);
        $Statement->bindValue(':email', $Email);
        $Result = $Statement->execute();
        $Rows = $Statement->fetchAll();

        if($Result && count($Rows) > 0)
            return true;

        return false;
    }

}