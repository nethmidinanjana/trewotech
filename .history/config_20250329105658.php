<?php

function loadEnv($path = __DIR__.'.env'){
    if(!file_exists(($path))){
        throw new Exception(".env file does not exist");
    }

    $lines  = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line){
        if(strpos(trim($line), '#') === 0){
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
    }
}