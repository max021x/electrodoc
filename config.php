<?php

$env = parse_ini_file('.env');

return [
    'app' => [
        'AppName' => $env['APP_NAME'] , 
    ] , 

    'database' => [
        'driver' => $env['DRIVER'] ,  
        'dbname' => $env['DBNAME'] , 
        'username' => $env['USERNAME'] , 
        'password' => $env['PASSWORD'] , 
    ]

] ; 
// composer require league/commonmark
