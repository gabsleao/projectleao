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

    break;

    case 'register_user':
        $User = new User();
        $Response = $User->registerUser($_POST);
        echo json_encode(['response' => $Response]);

    break;

    case 'logout':
        if(isset($_SESSION['iduser'])){
            $User = new User($_SESSION['iduser']);
            $Response = $User->killSession();
        }else{
            //Session nao está setada ou expirou
            $Response = ['status' => 500, 'message' => 'Whoops! Algo deu errado.'];
        }

        echo json_encode(['response' => $Response]);

    break;



    default:
        throw new Exception('Whoops! Operation inválida.');
}