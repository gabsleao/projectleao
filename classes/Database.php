<?php

class Database extends PDO{
    private $DBUSER = 'gabsleao';
    private $DBPASS = '6qwt43t_75hslVrO';
    private $DBHOST = IS_LOCALHOST ? 'localhost' : 'não sei kk';


    function __construct($Database = null){
        if(is_null($Database))
            throw new PDOException('Whoops! Database não setada.');
        
        $Connection = new mysqli($this->DBHOST, $this->DBUSER, $this->DBPASS, $Database);

        if ($Connection->connect_errno)
            Log::doLog("[1001] 1. Connection failed: ". var_export($Connection->connect_errno, 1), 'DatabaseError', 1);
        
            
        // if(!$Connection->connect() && !is_null($Connection->connect())){
        //     Log::doLog("[1001] Connect failed: ". var_export($Connection, 1), 'DatabaseError', 1);
        //     throw new PDOException('Whoops! Algo deu errado [CÓDIGO 1001]!');
        // }
        
        return $Connection;
    }
 
    function closeCon($Connection){
        $Connection->close();
    }
}