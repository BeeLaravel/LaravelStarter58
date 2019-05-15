<?php

Route::get('/', function () {
    return '/';
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index'); // laravel-log-viewer

