<?php

class LoginController{

    public $username = null;
    public $password = null;

    public function loginUser($Data){
        if(!isset($Data['username']) || is_null($Data['username']))
            throw new Exception('Whoops! Insira um nome de usuário.');

        if(!isset($Data['password']) || is_null($Data['password']))
            throw new Exception('Whoops! Insira uma senha.');

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
            return ['status' => 200, 'message' => 'Usuário logado com sucesso!', 'user' => $User];
        }else{
            Log::doLog('SQL:  <br>' . var_export($Sql, 1), 'Rows_loginUser', 1);
            return ['status' => 500, 'message' => 'Usuário não encontrado!'];
        }
    }
}