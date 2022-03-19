<?php
require_once __DIR__.'/../config/loaders.php';
Log::doLog(var_export($argv, 1), 'enteredBackground');
exit;
$Type = isset($argv[1]) ? $argv[1] : exit();
$Data = isset($argv[2]) ? $argv[2] : exit();

$Start = time();
try{

    switch($Type){
        case 'welcome_email':
            $Mail = new Mail();
            $Mail->sendWelcomeMail($Data);
        break;

        default: 
            echo 'Type invalido: ' . $Type;
        break;
    }

}catch(Exception $e){
    var_dump($e);
}
$Finish = time();
Log::doLog('sendMail.php - background finished, took ' . $Finish - $Start . ' seconds.', 'backgroundLogs');

