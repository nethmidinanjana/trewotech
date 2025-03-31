<?php

function loadEnv($path = __DIR__.'.env'){
    if(!file_exists(($path))){
        trow new Exception(".env file ")
    }
}