<?php

const ENCRYPT_KEY = '#L340Pr0j3cT!!';

//if localhost
if(isset($_SERVER['SERVER_NAME']) && strpos('localhost', $_SERVER['SERVER_NAME']) !== false){
    define('IS_LOCALHOST', true);
}

//if prod
if(isset($_SERVER['SERVER_NAME']) && strpos('localhost', $_SERVER['SERVER_NAME']) === false){
    define('IS_PROD', true);
}elseif(!defined('IS_LOCALHOST'))
    define('IS_LOCALHOST', true);


const DATABASE_ALL_USERS = 'all_users';
const PRODUCT_NAME = 'Project Leão';

if(defined('IS_PROD')){
    define('URL_PRODUTO', 'http://projectleao.atwebpages.com/');
}else
    define('URL_PRODUTO', 'http://localhost/projectleao/');