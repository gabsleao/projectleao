<?php
require_once __DIR__.'/../config/loaders.php';

if(!isset($_POST['operation']))
    throw new Exception('Whoops! Operation não setada.');

switch($_POST['operation']){
    case 'login_user':
    case 'register_user':
    case 'logout':
    case 'recover_pass':
        $Response = (new Controller())->controller($_POST);
        echo json_encode(['response' => $Response]);

    break;

    default:
        throw new Exception('Whoops! Operation inválida.');
}