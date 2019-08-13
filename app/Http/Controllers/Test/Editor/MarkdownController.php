<?php
namespace App\Http\Controllers\Test\Editor;

class MarkdownController extends Controller {
    public function markdown1() { // /test/editor/markdown1
    	return view('test.editor.markdown.markdown1');
    }
    public function markdownparse1() { // /test/editor/markdownparse1
    	return view('test.editor.markdown.markdownparse1');
    }

    public function markdown2() { // /test/editor/markdown2
    	return view('test.editor.markdown.markdown2');
    }
    public function markdownparse2() { // /test/editor/markdownparse2
    	return view('test.editor.markdown.markdownparse2');
    }
}
