<?php
//Header (CSS settings and SESSION) + loaders
require_once __DIR__.'/config/head.php';
require_once __DIR__.'/config/loaders.php';

if(Utils::isMobile())
    Log::doLog('index accessed through MOBILE!', 'isMobileCheck', 1);
else
    Log::doLog('index accessed through DESKTOP!', 'isMobileCheck', 1);

if(!isset($_SESSION['iduser']))
    require_once __DIR__.'/login_page.php';
else
    require_once __DIR__.'/dashboard.php';
