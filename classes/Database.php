<?php

class Database extends PDO{
    private $DBUSER = 'gabsleao';
    private $DBPASS = '6qwt43t_75hslVrO';
    private $DBHOST = IS_LOCALHOST ? 'localhost' : 'não sei kk';

    private $Connection = null;

    function __construct($Database = null){
        if(is_null($Database))
            throw new PDOException('Whoops! Database não setada.');

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