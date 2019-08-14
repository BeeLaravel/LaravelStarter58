<?php
namespace App\Http\Controllers\Test\Editor;

use League\HTMLToMarkdown\HtmlConverter;
use League\HTMLToMarkdown\Environment;
use League\HTMLToMarkdown\Converter\HeaderConverter;

use GrahamCampbell\Markdown\Facades\Markdown;
use League\CommonMark\ConverterInterface;

class MarkdownController extends Controller {
    // chenhua/laravel5-markdown-editor
    public function markdown1() { // /test/editor/markdown1
    	return view('test.editor.markdown.markdown1');
    }
    public function markdownparse1() { // /test/editor/markdownparse1
    	return view('test.editor.markdown.markdownparse1');
    }

    // yuanchao/laravel-5-markdown-editor
    public function markdown2() { // /test/editor/markdown2
    	return view('test.editor.markdown.markdown2');
    }
    public function markdownparse2() { // /test/editor/markdownparse2
    	return view('test.editor.markdown.markdownparse2');
    }

    // league/html-to-markdown
    public function markdown3() { // /test/editor/markdown3
        $converter = new HtmlConverter();

        $html = "<h3>Quick, to the Batpoles!</h3>";
        $markdown = $converter->convert($html);

        echo $markdown;


        $converter->getConfig()->setOption('strip_tags', true);

        $html = '<span>Turnips!</span>';
        $markdown = $converter->convert($html);

        echo $markdown;


        $converter = new HtmlConverter([
            'strip_tags' => true,
        ]);

        $html = '<span>Turnips!</span>';
        $markdown = $converter->convert($html);

        echo $markdown;


        $converter = new HtmlConverter([
            'remove_nodes' => 'span div',
        ]);

        $html = '<span>Turnips!</span><div>Monkeys!</div>';
        $markdown = $converter->convert($html);

        echo $markdown;


        $converter = new HtmlConverter();

        $converter->getConfig()->setOption('italic_style', '*');
        $converter->getConfig()->setOption('bold_style', '__');

        $html = '<em>Italic</em> and a <strong>bold</strong>';
        $markdown = $converter->convert($html);

        echo $markdown;


        $html = '<p>test<br>line break</p>';

        $converter->getConfig()->setOption('hard_break', true);
        $markdown = $converter->convert($html); // $markdown now contains "test\nline break"

        echo $markdown;

        $converter->getConfig()->setOption('hard_break', false); // default
        $markdown = $converter->convert($html); // $markdown now contains "test  \nline break"

        echo $markdown;


        $environment = new Environment([
        ]);
        $environment->addConverter(new HeaderConverter());
        $converter = new HtmlConverter($environment);

        $html = '<h3>Header</h3>
            <img src="" />';
        $markdown = $converter->convert($html);

        echo $markdown;
    }

    // graham-campbell/markdown GrahamCampbell/Laravel-Markdown
    public function markdown4() { // /test/editor/markdown4
        echo Markdown::convertToHtml('foo'); // <p>foo</p>
    }
    public function markdown41() {
        return view('test.editor.markdown.markdown41');
    }
    public function markdown42() {
        return view('test.editor.markdown.markdown42');
    }
    public function markdown43() {
        return view('test.editor.markdown.markdown43');
    }
}
// class Foo {
//     protected $converter;

//     public function __construct(ConverterInterface $converter) {
//         $this->converter = $converter;
//     }

//     public function bar() {
//         return $this->converter->convertToHtml('foo');
//     }
// }
// App::make('Foo')->bar();
