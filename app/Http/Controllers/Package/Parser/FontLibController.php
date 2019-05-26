<?php
namespace App\Http\Controllers\Package\Parser;

use FontLib\Font;

use App\Models\Tool\Font as FontModel;

class FontLibController extends Controller {
    public function index($id=1) {
        $font = FontModel::find($id);
        $font = Font::load(storage_path($font->url));
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

