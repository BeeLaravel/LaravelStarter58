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

		Route::get('/fontlib', 'Parser\FontLibController@index')->name('parser.fontlib'); // PhenX/php-font-lib
		Route::get('/pdfparser', 'Parser\PdfparserController@index')->name('parser.pdfparser'); // smalot/pdfparser
		Route::get('/markdown', 'Parser\MarkdownController@index')->name('parser.markdown'); // graham-campbell/markdown
		Route::get('/markdown2', 'Parser\MarkdownController@index2')->name('parser.markdown2');
		Route::get('/markdown3', 'Parser\MarkdownController@index3')->name('parser.markdown3');
		Route::get('/markdown4', 'Parser\MarkdownController@index4')->name('parser.markdown4');
		Route::get('/hashids', 'Parser\HashidsController@index')->name('parser.hashids');
        Route::get('/barcode', 'BarCodeController@index')->name('parser.barcode');;
	});
	// ### 迁移
	Route::group([
		'prefix' => 'rpc',
	], function ($router) {
		Route::get('etcd', 'Rpc\EtcdPHPController@index')->name('etcd.index');
		Route::get('activecollab-etcd', 'Rpc\ActivecollabEtcdController@index')->name('activecollab-etc.index');
	});

	Route::group([
		'prefix' => LaravelLocalization::setLocale(), // mcamara/laravel-localization
	], function() {
	});
});
