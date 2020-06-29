<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', '\Controllers\IndexController@index');
SimpleRouter::get('/movies', '\Controllers\MovieController@index')->name('movies');
SimpleRouter::get('/movie/create', '\Controllers\MovieController@create')->name('movie.create');
SimpleRouter::post('/movie', '\Controllers\MovieController@store')->name('movie.store');
SimpleRouter::get('/movie/{id}/edit', '\Controllers\MovieController@edit')->where(['id' => '[0-9]+'])->name('movie.edit');
SimpleRouter::post('/movie/{id}', '\Controllers\MovieController@update')->where(['id' => '[0-9]+'])->name('movie.update');
SimpleRouter::get('/movie/{id}/delete', '\Controllers\MovieController@destroy')->where(['id' => '[0-9]+'])->name('movie.delete');