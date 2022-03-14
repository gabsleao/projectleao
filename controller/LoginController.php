<?php

class LoginController{

    public $username = null;
    public $password = null;
    public $keep_me_loggedin = 0;

    public function loginUser($Data){
        if(!isset($Data['username']) || is_null($Data['username']))
            throw new Exception('Whoops! Insira um nome de usuário.');

        if(!isset($Data['password']) || is_null($Data['password']))
            throw new Exception('Whoops! Insira uma senha.');

        $Sql = 'SELECT * FROM users WHERE username = :username AND password  = AES_ENCRYPT("' . ENCRYPT_KEY . '", :password) LIMIT 1';
        $Db = new Database(DATABASE_ALL_USERS);
        Log::doLog('[0] - Db: ' . var_export($Db, 1), 'backtrace');
        $Statement = $Db->prepare($Sql);
        Log::doLog('[1] - Statement: ' . var_export($Statement, 1), 'backtrace');
        $Statement->bindValue(':username', $Data['username']);
        $Statement->bindValue(':password', $Data['password']);
        Log::doLog('[2] - after bindValue: ' . var_export($Statement, 1), 'backtrace');
        $Result = $Statement->execute();
        Log::doLog('[3] - Result:' . var_export($Result, 1), 'backtrace');
        $Rows = $Statement->fetchAll();
        Log::doLog('[4] - Rows' . var_export($Rows, 1), 'backtrace');
        if($Result && count($Rows) > 0){
            Log::doLog('Rows:  <br>' . var_export($Rows, 1), 'Rows_loginUser');
            
            return ['status' => 'success', 'message' => 'Usuário logado com sucesso!'];
        }else{
            Log::doLog('SQL:  <br>' . var_export($Sql, 1), 'Rows_loginUser', 1);
            return ['status' => 'failed', 'message' => 'Usuário não encontrado!'];
        }
    }
}