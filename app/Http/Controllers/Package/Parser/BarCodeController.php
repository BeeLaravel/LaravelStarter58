<?php
namespace App\Http\Controllers\Package\Parser;

use DNS1D;
use DNS2D;

class BarCodeController extends Controller {
    public function index($data='beesoft') {
        $typesOf1d = [
            'C39', 'C39+', 'C39E', 'C39E+', 'C93', 'S25',
            'S25+', 'I25', 'I25+', 'C128', 'C128A', 'C128B',
            'EAN2', 'EAN5', 'EAN8','EAN13', 'UPCA',
            'UPCE', 'MSI', 'MSI+', 'POSTNET', 'PLANET','RMS4CC',
            'KIX', 'CODABAR', 'CODE11', 'PHARMA', 'PHARMA2T'
        ];

        $barcodeOf1d = [];
        foreach ($typesOf1d as $type) {
            $barcodeOf1d[$type] = DNS1D::getBarcodePNG((string) $data, $type); // , 3, 20, [220, 220, 220]
        }

        $typesOf2d = [
            'QRCODE', 'QRCODE,L', 'QRCODE,M', 'QRCODE,Q', 'QRCODE,H',
            'DATAMATRIX', 'PDF417', 'PDF417,a,e',
        ];

        $barcodeOf2d = [];
        foreach ($typesOf2d as $type) {
            $barcodeOf2d[$type] = DNS2D::getBarcodePNG((string) $data, $type); // , 4, 8, [220, 220, 220]
        }

    	return view('package.parser.barcode', compact('barcodeOf1d', 'barcodeOf2d'));
    }
}

// getBarcodeSVG
// getBarcodeHTML
// getBarcodePNG
// getBarcodePNGPath
// getBarcodePNGUri
