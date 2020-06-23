<?php

require 'vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;
  
/* Ładowanie zewnętrznych plików ścieżek */
require_once 'routes/web.php';

// Rozpoczęcie routingu
SimpleRouter::start();
