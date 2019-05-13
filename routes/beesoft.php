<?php
Route::get('/', 'IndexController@index')->name('index');
Route::get('/weather/{city}', 'WeatherController@show')->name('weather'); // beesoft/weather

