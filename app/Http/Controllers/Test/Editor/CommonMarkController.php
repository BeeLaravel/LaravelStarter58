<?php
namespace App\Http\Controllers\Test\Editor;

use League\CommonMark\CommonMarkConverter;

use League\CommonMark\Environment;
use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use League\CommonMark\HtmlRenderer;

use Webuni\CommonMark\TableExtension\TableExtension;
use Webuni\CommonMark\AttributesExtension\AttributesExtension;
use Ows\CommonMark\SupExtension;
use Ows\CommonMark\SubExtension;
use League\CommonMark\Extras\CommonMarkExtrasExtension;
use League\CommonMark\Ext\Autolink\AutolinkExtension;
use League\CommonMark\Ext\Autolink\InlineMentionParser;
use League\CommonMark\Ext\TaskList\TaskListExtension;
use League\CommonMark\Ext\Strikethrough\StrikethroughExtension;

class CommonMarkController extends Controller {
    public function index() {
    	$converter = new CommonMarkConverter();
        echo $converter->convertToHtml('# Hello World!');
    }
    public function extras() {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new CommonMarkExtrasExtension());

        $config = [];

        $converter = new CommonMarkConverter($config, $environment);
        echo $converter->convertToHtml('# Hello World!');
    }

    public function autolink() {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new AutolinkExtension());

        $converter = new CommonMarkConverter([], $environment);
        echo $converter->convertToHtml('I successfully installed the https://github.com/thephpleague/commonmark-ext-autolink extension!');

        $environment->addInlineParser(InlineMentionParser::createTwitterHandleParser());
        $environment->addInlineParser(InlineMentionParser::createGithubHandleParser());
        $environment->addInlineParser(new InlineMentionParser('https://www.example.com/users/%s/profile'));
    }
    public function smartpunct() {}
    public function strikethrough() {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new StrikethroughExtension());

        $converter = new CommonMarkConverter($config, $environment);
        echo $converter->convertToHtml('This extension is ~~good~~ great!');
    }
    public function taskList() {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new TaskListExtension());

        $converter = new CommonMarkConverter([], $environment);
        $markdown = <<<EOT
         - [x] Install this extension
         - [ ] ???
         - [ ] Profit!
        EOT;
        echo $converter->convertToHtml($markdown);
    }
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
