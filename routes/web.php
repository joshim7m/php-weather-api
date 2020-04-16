<?php

use Illuminate\Support\Facades\Route;






Route::get('github/{user}', 'ApiController@getGithub');

Route::get('weather', 'ApiController@getWeather')->name('weather');
Route::post('weather/resutl', 'ApiController@postWeather')->name('weather.result');

Route::get('weatherjs', 'ApiController@getWeatherJs')->name('weatherjs');
Route::post('weather/ready', 'ApiController@postWeatherJs')->name('weather.ready');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
