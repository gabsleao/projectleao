<?php
  require_once __DIR__.'/loadClasses.php';
  require_once __DIR__.'/loadControllers.php';
  require_once __DIR__.'/constantes.php';

  if(session_status() == PHP_SESSION_NONE)
    session_start();
  
?>