<?php
//Load libs
require_once(__DIR__ . '/../classes/php_mailer/PHPMailer.php');
require_once(__DIR__ . '/../classes/php_mailer/SMTP.php');
require_once(__DIR__ . '/../classes/php_mailer/Exception.php');

/* Syntax pra usar o PHPMailer: */
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

$Dir = __DIR__ . '/../classes/';

//Load Classes padrão
//Pegar nome dos files dentro do folder classes/
$Classes = array_diff(scandir($Dir), array('.', '..'));  
includeClasses($Classes, $Dir);


function existClass($Class, $Dir){
    //Only include .php classes (not folders)
    if(file_exists($Dir . $Class) && strpos($Class, '.php'))
        return true;

    return false;
}

function includeClasses($Classes, $Dir, ){
    foreach($Classes as $Class){
        if(existClass($Class, $Dir))
            include $Dir . $Class;
    }
}