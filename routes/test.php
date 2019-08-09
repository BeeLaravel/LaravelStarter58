<?php
Route::get('system/index', 'SystemController@index')->name('test.system.index');

Route::get('soap/soap', 'SoapController@soap')->name('test.soap.soap');
Route::get('soap/goodcang', 'SoapController@goodcang')->name('test.soap.goodcang');

// Symfony
Route::get('symfony/workflow', 'Symfony\WorkflowController@index')->name('test.symfony.workflow');

// 资源
Route::get('resource/lattice', 'Resource\LatticeController@index')->name('test.resource.lattice'); // jc91715/lattice 点阵图
