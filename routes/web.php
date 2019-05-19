<?php

Route::get('/', function () {
    return '/';
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index'); // laravel-log-viewer
Route::get('decompose','\Lubusin\Decomposer\Controllers\DecomposerController@index'); // lubusin/laravel-decomposer
Route::get('decompose/array', function() {
    dd(Lubusin\Decomposer\Decomposer::getReportArray());
});
Route::get('decompose/json', function() {
    dd(Lubusin\Decomposer\Decomposer::getReportJson());
});

