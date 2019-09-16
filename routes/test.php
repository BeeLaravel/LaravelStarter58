<?php
Route::get('system/index', 'SystemController@index')->name('test.system.index');

Route::get('soap/soap', 'SoapController@soap')->name('test.soap.soap');
Route::get('soap/goodcang', 'SoapController@goodcang')->name('test.soap.goodcang');

// ### Symfony
Route::get('symfony/workflow', 'Symfony\WorkflowController@index')->name('test.symfony.workflow');

// ### 资源
Route::get('resource/lattice', 'Resource\LatticeController@index')->name('test.resource.lattice'); // jc91715/lattice 点阵图
Route::get('resource/opening', 'Resource\TimeController@opening')->name('test.resource.opening'); // spatie/opening-hours 营业时间

// ### 编辑器
Route::get('editor/markdown1', 'Editor\MarkdownController@markdown1')->name('test.editor.markdown1'); // chenhua/laravel5-markdown-editor
Route::get('editor/markdownparse1', 'Editor\MarkdownController@markdownparse1')->name('test.editor.markdownparse1');
Route::get('editor/markdown2', 'Editor\MarkdownController@markdown2')->name('test.editor.markdown2'); // yuanchao/laravel-5-markdown-editor
Route::get('editor/markdownparse2', 'Editor\MarkdownController@markdownparse2')->name('test.editor.markdownparse2');
Route::get('editor/markdown3', 'Editor\MarkdownController@markdown3')->name('test.editor.markdown3'); // yuanchao/laravel-5-markdown-editor
Route::get('editor/markdown4', 'Editor\MarkdownController@markdown4')->name('test.editor.markdown4'); // graham-campbell/markdown GrahamCampbell/Laravel-Markdown
Route::get('editor/markdown41', 'Editor\MarkdownController@markdown41')->name('test.editor.markdown41');
Route::get('editor/markdown42', 'Editor\MarkdownController@markdown42')->name('test.editor.markdown42');
Route::get('editor/markdown43', 'Editor\MarkdownController@markdown43')->name('test.editor.markdown43');

Route::get('editor/commonmark1', 'Editor\CommonMarkController@index')->name('test.editor.commonmark1');
Route::get('editor/commonmark2', 'Editor\CommonMarkController@extras')->name('test.editor.commonmark2');
Route::get('editor/commonmark/subsup', 'Editor\CommonMarkController@subsup')->name('test.editor.commonmark.subsup'); // ok

Route::get('editor/ueditor', 'Editor\EditorController@ueditor')->name('test.editor.ueditor');
// Route::get('editor/ueditor', 'Editor\EditorController@ueditor')->name('test.editor.ueditor');

Route::get('opening-hours', function() {
    $openingHours = \Spatie\OpeningHours\OpeningHours::create([
        'monday'     => ['09:00-12:00', '13:00-18:00'],
        'tuesday'    => ['09:00-12:00', '13:00-18:00']
    ]);
});

// ### BeeSoft
Route::get('weather1/{city}/{type?}', 'Beesoft\WeatherController@city1'); // beesoft/weather
Route::get('weather2/{city}/{type?}', 'Beesoft\WeatherController@city2');

// ### 基础概念
Route::get('php/variable/assign-memory', 'PHP\VariableController@assignMemory'); // asignMemory
Route::get('php/variable/ref-memory', 'PHP\VariableController@refMemory'); // refMemory
Route::get('php/variable/assign-detail', 'PHP\VariableController@assignDetail'); // asignDetail
Route::get('php/variable/ref-detail', 'PHP\VariableController@refDetail'); // refDetail
Route::get('php/variable/test', 'PHP\VariableController@test'); // test
Route::get('php/variable/cast', 'PHP\VariableController@cast'); // cast