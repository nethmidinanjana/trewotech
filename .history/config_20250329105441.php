<?php

function loadEnv($path = __DIR__.'.env'){
    if(!file_exists(($path))){
        throw new Exception(".env file does not exist");
    }

    $lines  = 
}