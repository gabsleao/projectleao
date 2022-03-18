<?php
//Header and CSS settings
require_once __DIR__.'/config/head.php';
require_once __DIR__.'/config/loaders.php';

if(!isset($_SESSION['iduser']))
    require_once __DIR__.'/login_page.php';
else
    require_once __DIR__.'/dashboard.php';
