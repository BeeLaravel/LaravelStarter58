<?php
namespace App\Http\Controllers\Package\Parser;

use FontLib\Font;

class FontLibController extends Controller {
    public function index() {
        $font = Font::load(public_path('/fonts/zh_CN/founder_hard_xing.ttf'));
        $font->parse();

        echo "FontName: " . $font->getFontName() .'<br>';
        echo "FontFullName: " . $font->getFontFullName() .'<br>';
        echo "FontPostscriptName: " . $font->getFontPostscriptName() .'<br>';
        echo "FontSubfamily: " . $font->getFontSubfamily() .'<br>';
        echo "FontSubfamilyID: " . $font->getFontSubfamilyID() .'<br>';
        echo "FontVersion: " . $font->getFontVersion() .'<br>';
        echo "FontCopyright: " . $font->getFontCopyright() .'<br>';
        echo "FontWeight: " . $font->getFontWeight() .'<br>';
        echo "FontType: " . $font->getFontType() .'<br>';
        $font->setSubset('储成英');
        echo "Subset: " . print_r($font->getSubset(), 1) .'<br>';
    }
}

