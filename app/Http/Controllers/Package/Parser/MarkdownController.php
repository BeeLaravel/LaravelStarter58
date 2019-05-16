<?php
namespace App\Http\Controllers\Package\Parser;

use GrahamCampbell\Markdown\Facades\Markdown;

class MarkdownController extends Controller {
    public function index() {
    	return view('package.parser.markdown');
    }
    public function index2() {
    	return view('package.parser.markdown2');
    }
    public function index3() {
        return view('package.parser.markdown3');
    }
    public function index4() {
    	echo Markdown::convertToHtml('foo');;
    }
}

