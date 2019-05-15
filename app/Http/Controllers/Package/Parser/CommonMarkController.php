<?php
namespace App\Http\Controllers\Package\Parser;

use League\CommonMark\CommonMarkConverter;

use League\CommonMark\Environment;
use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use League\CommonMark\HtmlRenderer;

use Webuni\CommonMark\TableExtension\TableExtension;
use Webuni\CommonMark\AttributesExtension\AttributesExtension;
use Ows\CommonMark\SupExtension;
use Ows\CommonMark\SubExtension;

class CommonMarkController extends Controller {
    public function index() {
    	$converter = new CommonMarkConverter();
        echo $converter->convertToHtml('# Hello World!');
    }
    public function extras() {}
    public function autolink() {}
    public function smartpunct() {}
    public function strikethrough() {}
    public function taskList() {}
    public function inlinesOnly() {}
    public function table() {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new TableExtension());

        $converter = new Converter(new DocParser($environment), new HtmlRenderer($environment));
        echo $converter->convertToHtml(
            'th | th(center) | th(right)
            ---|:----------:|----------:
            td | td         | td
            [*Prototype* table][reference_table]'
        );
    }
    public function attributes() {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new AttributesExtension());

        $converter = new Converter(new DocParser($environment), new HtmlRenderer($environment));
        echo $converter->convertToHtml(
            '> A nice blockquote
            {: title="Blockquote title"}

            {#id .class}
            ## Header

            This is *red*{style="color: red"}.'
        );
    }
    public function subsup() {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new SupExtension());
        $environment->addExtension(new SubExtension());

        $converter = new Converter(new DocParser($environment), new HtmlRenderer($environment));
        echo $converter->convertToHtml(
            '10^2^
            10~2~'
        );
    }
}
