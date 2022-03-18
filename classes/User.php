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

}