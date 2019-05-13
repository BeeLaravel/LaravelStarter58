<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	// Request $request
    public function __construct() {
    	// log_route([
		// 	'system' => config('app.name'),
		// 	'action' => $request->route()->getActionName(), // $action['controller']
		// 	'method' => $request->method(),
		// 	'url' => $request->url(), // URL::full() url()->full() URL::current() url()->current() Request::url()
		// 	'request' => json_encode($request->all()),
		// 	'description' => '',
		// 	'status' => '',
		// 	'result' => '',
    	// ]);
    }
}
