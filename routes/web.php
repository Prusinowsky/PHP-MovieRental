<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', '\Controllers\IndexController@index');
SimpleRouter::get('/home', '\Controllers\IndexController@show');