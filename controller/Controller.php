<?php
require_once __DIR__.'/../config/loaders.php';

if(!isset($_POST))
    throw new Exception('Whoops! Algo deu errado.');

if(!isset($_POST['operation']))
    throw new Exception('Whoops! Falha em determinar operation.');

switch($_POST['operation']){
    case 'login_user':
        $Response = (new LoginController())->loginUser($_POST);
        echo json_encode(['response' => $Response]);
        Log::doLog('Response:<br>' . json_encode(['response' => $Response]), 'Response', 1);
    break;

    case 'register_user':
        $User = new User();
        $Response = $User->registerUser($_POST);
        echo json_encode(['response' => $Response]);
    default:
        throw new Exception('Whoops! Operation inválida.');
}