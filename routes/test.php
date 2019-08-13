<?php
Route::get('system/index', 'SystemController@index')->name('test.system.index');

Route::get('soap/soap', 'SoapController@soap')->name('test.soap.soap');
Route::get('soap/goodcang', 'SoapController@goodcang')->name('test.soap.goodcang');

// ### Symfony
Route::get('symfony/workflow', 'Symfony\WorkflowController@index')->name('test.symfony.workflow');

// ### 资源
Route::get('resource/lattice', 'Resource\LatticeController@index')->name('test.resource.lattice'); // jc91715/lattice 点阵图

// ### 编辑器
Route::get('editor/markdown1', 'Editor\MarkdownController@markdown1')->name('test.editor.markdown1'); // chenhua/laravel5-markdown-editor
Route::get('editor/markdownparse1', 'Editor\MarkdownController@markdownparse1')->name('test.editor.markdownparse1');
Route::get('editor/markdown2', 'Editor\MarkdownController@markdown2')->name('test.editor.markdown2'); // yuanchao/laravel-5-markdown-editor
Route::get('editor/markdownparse2', 'Editor\MarkdownController@markdownparse2')->name('test.editor.markdownparse2');
