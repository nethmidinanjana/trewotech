<?php

function loadEnv($path = __DIR__.'.env'){
    if(!file_exists(($path))){
        throw new Exception(".env file does not exist");
    }

    $lines  = file($path, FILE_IGNORE_NEW_LINES | FIL)
}