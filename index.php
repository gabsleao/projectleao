<?php
//Header and CSS settings
require_once __DIR__.'/config/head.php';
require_once __DIR__.'/config/loaders.php';

Log::doLog(isset($_SESSION) ? var_export($_SESSION, 1) : 'not set', 'SessionsAfterSet3');

if(!isset($_SESSION['iduser']))
    require_once __DIR__.'/login_page.php';
else
    require_once __DIR__.'/dashboard.php';
