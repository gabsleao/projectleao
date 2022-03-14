<?php
require_once __DIR__.'/../config/head.php';

if(!isset($_POST))
    throw new Exception('Whoops! Algo deu errado.');

if(!isset($_POST['operation']))
    throw new Exception('Whoops! Falha em determinar operation.');

switch($_POST['operation']){
    case 'login_user':
        $Response = (new LoginController())->loginUser($_POST);
        Log::doLog('Response:<br>' . var_export($Response, 1), 'Response');
    break;

    default:
        throw new Exception('Whoops! Operation inválida.');
}