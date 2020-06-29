<?php

require 'vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;
use Illuminate\Database\Capsule\Manager as Capsule;
  
define('APP_PATH', __DIR__);
define('APP_PUBLIC_PATH', __DIR__.'/public');

global $db;
global $config;
global $router;

// Ładowanie konfiguracji
$config = require_once('configs/config.php');

// Ładowanie zewnętrznych plików ścieżek
require_once 'routes/web.php';

// Ustawianie połączenia z bazą danych
$db = new \MeekroDB(
    $config['database']['host'],
    $config['database']['username'], 
    $config['database']['password'], 
    $config['database']['database'], 
    $config['database']['port'], 
    $config['database']['encoding']
);


// Rozpoczęcie routingu
$router = SimpleRouter::start();