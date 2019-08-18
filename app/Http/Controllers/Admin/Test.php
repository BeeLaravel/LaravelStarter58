<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Mention;
use Parsedown;
use League\HTMLToMarkdown\HtmlConverter;
use Purifier;

class Test extends Controller {
    protected $htmlParser;
    protected $markdownParser;

    public function __construct() {
        $this->htmlParser = new HtmlConverter(['header_style' => 'atx']);
        $this->markdownParser = new Parsedown();
    }

    public function t2(Request $request) {
        $mention = new Mention();
        $content = $request->input(‘content‘);
        $markdownContent = $mention->parse($content);

        $htmlContent = $this->convertMarkdownToHtml($markdownContent);
        var_dump($htmlContent);exit;
    }

    public function convertHtmlToMarkdown($html) {
        return $this->htmlParser->convert($html);
    }

    public function convertMarkdownToHtml($markdown) {
        $convertedHmtl = $this->markdownParser->setBreaksEnabled(true)->text($markdown);
        $convertedHmtl = Purifier::clean($convertedHmtl, ‘user_topic_body‘);
        $convertedHmtl = str_replace("<pre><code>", ‘<pre><code class=" language-php">‘, $convertedHmtl);

        return $convertedHmtl;
    }
}
