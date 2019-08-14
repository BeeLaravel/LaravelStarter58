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

// ### 其他
Route::post('markdown/editormd/upload', function() { // chenhua/laravel5-markdown-editor 图片上传
    $info = \Chenhua\MarkdownEditor\MarkdownEditor::upload();
    return json_encode($info);
});
Route::post('markdown/endaEdit/upload', function() { // yuanchao/laravel-5-markdown-editor 图片上传
    $data = \YuanChao\Editor\EndaEditor::uploadImgFile('uploads/endaEdit'); // uploads/endaEdit uploads/markdown uploads/images
    return json_encode($data);     
});