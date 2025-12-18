<?php

use Core\App;
use Core\Database;

require_once "vendor/autoload.php" ; 
$config = require_once "config.php" ; 



App::bind('config' , $config) ; 
App::bind('database' , new Database($config['database'])) ; 

