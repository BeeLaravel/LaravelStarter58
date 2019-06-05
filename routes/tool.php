<?php
Route::group([
	// 'middleware' => ['auth:admin']
], function ($router) {
	$router->get('/applications', 'IndexController@applications')->name('applications'); // applications
	$router->get('/packages', 'IndexController@packages')->name('packages'); // packages
	$router->get('/files', 'IndexController@files')->name('files'); // files
	$router->get('/fonts', 'IndexController@fonts')->name('fonts'); // fonts
	$router->get('/custom_fonts', 'IndexController@custom_fonts')->name('custom_fonts'); // custom_fonts
	$router->get('/svgs', 'IndexController@svgs')->name('svgs'); // svgs
	$router->get('/accounts', 'IndexController@accounts')->name('accounts'); // accounts
});
// php
Route::get('php/info', 'PHPController@info')->name('tool.php.info');

Route::get('database/references', 'Database\ReferenceController@index')->name('tool.database.references');

Route::get('database/browser', 'Database\BrowserController@index')->name('tool.database.browser');
Route::post('database/browser/server', 'Database\BrowserController@server')->name('tool.database.browser.server');
Route::post('database/browser/table', 'Database\BrowserController@table')->name('tool.database.browser.table');
Route::get('database/browser/server', 'Database\BrowserController@server')->name('tool.database.browser.server');
Route::get('database/browser/table', 'Database\BrowserController@table')->name('tool.database.browser.table');

