<?php
namespace App\Http\Controllers\Package\Parser;

use Smalot\PdfParser\Parser;

class GeoIPController extends Controller {
    public function index() {
    	$ip = '119.4.121.109';
        $data = geoip($ip)->toArray();
        return $data;
    }
}
