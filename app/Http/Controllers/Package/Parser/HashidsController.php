<?php
namespace App\Http\Controllers\Package\Parser;

use Vinkla\Hashids\Facades\Hashids;

class HashidsController extends Controller {
    public function index() {
    	echo $hashId = Hashids::encode(10);
        print_r(Hashids::decode($hashId));
    }
}

