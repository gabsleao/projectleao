<?php

$Classes = ['Log'];

foreach($Classes as $Class){
    if(existClass($Class))
        include __DIR__ . '/../classes/' . $Class . '.php';
}


function existClass($Class){
    if(file_exists(__DIR__ . '/../classes/' . $Class . '.php'))
        return true;

    return false;
}