<?php

$Controllers = ['LoginController'];

foreach($Controllers as $Controller){
    if(existController($Controller))
        include __DIR__ . '/../controller/' . $Controller . '.php';
}


function existController($Controller){
    if(file_exists(__DIR__ . '/../controller/' . $Controller . '.php'))
        return true;

    return false;
}