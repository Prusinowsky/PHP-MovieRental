<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', '\Controllers\IndexController@index');
SimpleRouter::get('/movies', '\Controllers\IndexController@index');
SimpleRouter::get('/movie/add', function(){
    return 'TODO';
});
SimpleRouter::get('/movie/show/{id}', '\Controllers\IndexController@show');
SimpleRouter::get('/movie/edit/{id}', '\Controllers\IndexController@show');
SimpleRouter::get('/movie/delete/{id}', '\Controllers\IndexController@show');