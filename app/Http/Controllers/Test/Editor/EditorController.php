<?php
namespace App\Http\Controllers\Test\Editor;



class EditorController extends Controller {
    // overtrue/laravel-ueditor
    public function ueditor() {
        return view('test.editor.editor.ueditor');
    }
}
