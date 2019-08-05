<?php
namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;

class IndexController extends Controller {
    public function index() {
    	return view("warehouse.index", [
    		'title' => '仓库管理系统',
    	]);
    }
}
