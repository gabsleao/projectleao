<?php
require_once __DIR__.'/../config/loaders.php';

$Type = isset($argv[1]) ? $argv[1] : exit();
$Filename = isset($argv[2]) ? $argv[2] : exit();

try{
    $Start = time();

    if(file_exists(__DIR__ . '/../tmp/' . $Filename)){
        $FileContent = file_get_contents(__DIR__ . '/../tmp/' . $Filename);
        $Data = json_decode($FileContent);
        unlink(__DIR__ . '/../tmp/' . $Filename); 
    }
    
    if(!is_array($Data) && !is_object($Data))
        return;

    //If not array, transform
    if(!is_array($Data))
        $Data = (array) $Data;

    switch($Type){
        case 'welcome_email':
            $Mail = new Mail();
            $Mail->sendWelcomeMail($Data);
        break;

        default: 
            echo 'Type invalido: ' . $Type;
        break;
    }

    $Finish = time();
    Log::doLog('sendMail.php - background finished, took ' . ($Finish - $Start) . ' seconds.', 'sendMail-runtime');

}catch(Exception $e){
    Log::doLog(var_export($e, 1), 'sendMail-exception');
}

