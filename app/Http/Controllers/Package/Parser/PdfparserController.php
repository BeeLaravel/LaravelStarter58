<?php
namespace App\Http\Controllers\Package\Parser;

use Smalot\PdfParser\Parser;

class PdfparserController extends Controller {
    public function index() {
    	$parser = new Parser();
        $pdf = $parser->parseFile(public_path('pdfs/docker_mysql.pdf'));
        
        $text = $pdf->getText();
        echo $text."<br>\n";
        
        $pages = $pdf->getPages();
        foreach ( $pages as $key => $page ) {
            echo "第" . ($key+1) . "页: " . $page->getText()."<br>\n";
        }

        $details  = $pdf->getDetails();
        foreach ( $details as $property => $value ) {
            if ( is_array($value) ) $value = implode(', ', $value);

            echo $property . ' => ' . $value . "<br>\n";
        }
    }
}

