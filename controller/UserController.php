<?php

class UserController{

    public $username = null;
    public $password = null;

    public function loginUser($Data){
        if(!isset($Data['username']) || is_null($Data['username']))
            throw new Exception('Whoops! Insira um nome de usuário.');

        if(!isset($Data['password']) || is_null($Data['password']))
            throw new Exception('Whoops! Insira uma senha.');

        $User = new User();
        $Response = $User->loginUser($Data);

        if($Response)
            return ['status' => 200, 'message' => 'Usuário logado com sucesso!'];
        
        return ['status' => 500, 'message' => 'Usuário não encontrado!'];
    }

    public function registerUser($Data = []){
        if(!isset($Data['username']) || is_null($Data['username']))
            throw new Exception('Whoops! Insira um nome de usuário.');

        if(!isset($Data['password']) || is_null($Data['password']))
            throw new Exception('Whoops! Insira uma senha.');

        if(!isset($Data['email']) || is_null($Data['email']))
            throw new Exception('Whoops! Insira um email.');

        $User = new User();
        $Response = $User->registerUser($Data);

        if($Response)
            return ['status' => 200, 'message' => 'Usuário registrado com sucesso!'];
        
        return ['status' => 500, 'message' => 'Usuário não foi registrado!'];
        
    }

    public function killSession(){
        $User = new User();
        $Response = $User->killSession();

        if($Response)
            return ['status' => 200, 'message' => 'Usuário deslogado com sucesso!'];
        
        return ['status' => 500, 'message' => 'Usuário não foi deslogado!'];
    }

    public function recoverPass($Data = []){
        if(!isset($Data['email']) || is_null($Data['email']))
            throw new Exception('Whoops! Insira um email.');

        $User = new User();
        $Response = $User->recoverPass($Data);

        if($Response)
            return ['status' => 200, 'message' => 'Usuário registrado com sucesso!'];
        
        return ['status' => 500, 'message' => 'Usuário não foi registrado!'];
        
    }
}