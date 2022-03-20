<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail extends PHPMailer{

    public $TemplatesDir = (__DIR__ . '/../assets/brand/email_templates/');
    public $CredentialsFile = (__DIR__ . '/../config/credentials-mail.json');
    public $SenderName = 'Equipe ' . PRODUCT_NAME;

    public function __construct(){
        if(file_exists($this->CredentialsFile)){
            $Credentials = json_decode(file_get_contents($this->CredentialsFile));
            $this->Username = $Credentials->Username;
            $this->Password = $Credentials->Password;
            $this->Host = $Credentials->Host;
            $this->Port = $Credentials->Port;
        }
        
    }

    private function sendMail($Subject = null, $Body = null, $Recipient = null){
        if(is_null($Subject))
            return;

        if(is_null($Body))
            return;

        if(is_null($Recipient))
            return;
        
        if(IS_LOCALHOST)
            $this->SMTPDebug = SMTP::DEBUG_SERVER;

        try{
            $this->isSMTP();
            $this->setFrom($this->Username);
            $this->addAddress($Recipient);

            $this->isHTML(true);
            $this->Subject = $Subject;
            $this->Body = $Body;
            $this->AltBody = strip_tags($Body);

            if($this->send())
                return true;
            
            return false;

        }catch(Exception $e){
            Log::doLog(var_export($e, 1), __FUNCTION__ . '-exception');
            Log::doLog(var_export($this->ErrorInfo, 1), __FUNCTION__ . '-ErrorInfo');
        }

    }

    public function sendWelcomeMail($Recipient = []){
        if(is_null($Recipient['email']))
            return;

        if(!file_exists($this->TemplatesDir . 'welcome_email.html')){
            Log::doLog(var_export($this->TemplatesDir . 'welcome_email.html', 1), 'sendWelcomeMail_dir');
            return;
        }
        $Subject = 'Bem vindo ao Project Leão!';
        $Template = $this->TemplatesDir . 'welcome_email.html';

        //Replace as variaveis do template
        $Replace = array('%URL_PRODUTO%', '%PRODUCT_NAME%', '%SENDER_NAME%', '%USER_NAME%');
        $With = array(URL_PRODUTO, PRODUCT_NAME, $this->SenderName, $Recipient['username']);

        $Body = str_replace($Replace, $With, file_get_contents($Template));

        if($this->sendMail($Subject, $Body, $Recipient['email']))
            return true;

        return false;
            
    }

}