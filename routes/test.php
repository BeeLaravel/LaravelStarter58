<?php
Route::get('system/index', 'SystemController@index')->name('test.system.index');

Route::get('soap/soap', 'SoapController@soap')->name('test.soap.soap');
Route::get('soap/goodcang', 'SoapController@goodcang')->name('test.soap.goodcang');

Route::get('symfony/workflow', 'Symfony\WorkflowController@index')->name('test.symfony.workflow');