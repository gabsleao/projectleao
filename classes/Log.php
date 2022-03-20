<?php

class Log {
	
    //Where the logs will be stored
	public $folder = __DIR__ . '/../logs';
	
    //For possible scenarios where other folders are neccessary
	//function __construct($folder = null){
	//	$this->setFolder($folder);
	//}
	
	//private function setFolder($folder){
	//	//Use default folder if NULL
    //    if(is_null($folder))
	//	    $this->folder = __DIR__ . '/../logs';
    //    else
    //        $this->folder = rtrim($folder, '/');
	//}



    static function doLog($content, $folderName, $showBacktrace = 0){
        $Content = /*'[' . date('d M Y H:i:s', time()) . ' UTC] - Content: <br>' .*/ var_export($content ?? null, 1) . PHP_EOL. PHP_EOL;
        if($showBacktrace){
            $Content .= '1. REQUEST:' . var_export($_REQUEST ?? null, 1) . PHP_EOL .PHP_EOL;
            $Content .= '2. SESSION:' . var_export($_SESSION ?? null, 1) . PHP_EOL .PHP_EOL;
            $Content .= '3. POST:' . var_export($_POST ?? null, 1) . PHP_EOL .PHP_EOL;
            $Content .= '4. GET:' . var_export($_GET ?? null, 1) . PHP_EOL . PHP_EOL;
            $Content .= 'SERVER_NAME:' . var_export($_SERVER['SERVER_NAME'] ?? null, 1) . ' / HTTP_HOST: ' . var_export($_SERVER['HTTP_HOST'] ?? null, 1) . PHP_EOL .PHP_EOL;
            $Content .= 'HTTP_USER_AGENT:' . var_export($_SERVER['HTTP_USER_AGENT'] ?? null, 1) . PHP_EOL . PHP_EOL;
            $Content .= 'REQUEST_TIME:' . var_export(date('d M Y H:i:s', $_SERVER['REQUEST_TIME'] ?? null), 1) . ' UTC' . PHP_EOL;
        }
        $Content .= '<br>_____________________________________________________________________________________________________________________________<br><br>';
        $Folder = __DIR__ . '/../logs/' . date('d-m-Y') . '/' . $folderName . '.html';
        
        if (!file_exists(__DIR__ . '/../logs/' . date('d-m-Y')))
            mkdir(__DIR__ . '/../logs/' . date('d-m-Y'), 0777, true);
        
        file_put_contents($Folder, $Content, FILE_APPEND);
    }
	
}