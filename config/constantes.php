<?php

const ENCRYPT_KEY = '#L340Pr0j3cT!!';

//if localhost
if(isset($_SERVER['SERVER_NAME']) && strpos('localhost', $_SERVER['SERVER_NAME']) !== false){
    define('IS_LOCALHOST', true);
    define('URL_PRODUTO', 'http://localhost/projectleao/');
}

//if prod
if(isset($_SERVER['SERVER_NAME']) && strpos('localhost', $_SERVER['SERVER_NAME']) === false){
    define('IS_PROD', true);
    define('URL_PRODUTO', 'http://projectleao.atwebpages.com/');
}


const DATABASE_ALL_USERS = 'all_users';
const PRODUCT_NAME = 'Project Leão';
