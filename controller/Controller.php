<?php
class Controller{

    public function controller($Data){
        if(!isset($Data['operation']))
            throw new Exception('Whoops! Data operation not set.');

        switch($Data['operation']){
            case 'login_user':
                $Response = (new UserController())->loginUser($Data);
            break;

            case 'register_user':
                $Response = (new UserController())->registerUser($Data);
            break;

            case 'logout':
                $Response = (new UserController())->killSession();
            break;

            case 'recover_pass':
                $Response = (new UserController())->recoverPass($Data);
            break;
        }

        return $Response;
    }
}