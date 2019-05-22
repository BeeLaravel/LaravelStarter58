<?php
namespace App\Http\Controllers\Tool;

class PHPController extends Controller {
    public function info() {
        phpinfo();
    }
}

