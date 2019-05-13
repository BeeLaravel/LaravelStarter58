<?php
Route::group([], function ($router) {
	// ### 查询
	Route::group([
		'prefix' => 'query',
	], function ($router) {
        Route::get('/', 'Query\IndexController@index')->name('query.index');

        Route::get('/searchstring', 'Query\SearchStringController@index')->name('query.searchstring.index'); // lorisleiva/laravel-search-string
    });
    // ### 迁移
	Route::group([
		'prefix' => 'migrate',
	], function ($router) {
		Route::get('/', 'Migrate\IndexController@index')->name('migrate.index');
	});
	// ### 解析器
	Route::group([
		'prefix' => 'parser',
	], function ($router) {
		Route::get('/', 'Parser\IndexController@index')->name('parser.index');

		Route::get('/fontlib', 'Parser\FontLibController@index')->name('parser.index'); // PhenX/php-font-lib
		Route::get('/pdfparser', 'Parser\PdfparserController@index')->name('parser.index'); // smalot/pdfparser
	});
});
