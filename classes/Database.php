<?php

class Database extends PDO{
    public $CredentialsFile = (__DIR__ . '/../config/credentials-db.json');
    private $DBUSER = '';
    private $DBPASS = '';
    private $DBHOST = IS_LOCALHOST ? 'localhost' : 'não sei kk';

    private $Connection = null;

    function __construct($Database = null){
        if(is_null($Database))
            throw new PDOException('Whoops! Database não setada.');

        if(file_exists($this->CredentialsFile)){
            $Credentials = file_get_contents(json_decode($this->CredentialsFile));
            $this->DBUSER = $Credentials['DBUSER'];
            $this->DBPASS = $Credentials['DBPASS'];
        }

        try {
            $this->Connection = parent::__construct('mysql:host='. $this->DBHOST . ';dbname=' . $Database, $this->DBUSER, $this->DBPASS);
            
        } catch(PDOException $e) {
            Log::doLog("[1001] 1. Connection failed: " . $e->getMessage(), 'DatabaseError', 1);
        }
        
        return $this->Connection;
    }
 
    function closeCon($Connection){
        $Connection->close();
    }
}