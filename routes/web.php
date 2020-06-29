<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', '\Controllers\IndexController@index');
SimpleRouter::get('/movies', '\Controllers\MovieController@index')->name('movies');
SimpleRouter::get('/movie/create', '\Controllers\MovieController@create')->name('movie.create');
SimpleRouter::post('/movie', '\Controllers\MovieController@store');