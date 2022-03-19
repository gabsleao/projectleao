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
    break;

    default:
        $Response = ['status' => 404, 'message' => 'Operation não encontrada!'];
    break;
}

echo json_encode(['response' => $Response]);