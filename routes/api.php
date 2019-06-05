<?php
// use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ### Dingo API
$api = app('Dingo\Api\Routing\Router');

// $api->group(['middleware' => ['auth:api']], function ($api) {
    $api->version('v1', [
    	// 'namespace' => 'App\Http\Controllers\Api',
    	'middleware' => ['cors'], // 'serializer:array', 'bindings', 'change-locale', 
    ], function ($api) { // v1
		// #### tool
		$api->resource('applications', '\App\Http\Controllers\Api\Tool\ApplicationController'); // applications
        $api->resource('packages', '\App\Http\Controllers\Api\Tool\PackageController'); // packages
		$api->resource('files', '\App\Http\Controllers\Api\Tool\FileController'); // files
		$api->resource('fonts', '\App\Http\Controllers\Api\Tool\FontController'); // fonts
		$api->resource('custom_fonts', '\App\Http\Controllers\Api\Tool\CustomFontController'); // custom_fonts
		$api->resource('svgs', '\App\Http\Controllers\Api\Tool\SvgController'); // svgs
		$api->resource('accounts', '\App\Http\Controllers\Api\Tool\AccountController'); // accounts
		$api->get('download/{category}/{id}', '\App\Http\Controllers\Api\Tool\DownloadController@download'); // download
		// // 投票 Vote
	    // $api->resource('votes', '\App\Http\Controllers\Api\Vote\VoteController'); // 投票 Vote
	    // $api->resource('vote_users', '\App\Http\Controllers\Api\Vote\UserController'); // 用户 User
	    // $api->get('votes/{vote_id}/users', '\App\Http\Controllers\Api\Vote\UserController@index');
	    // $api->resource('vote_logs', '\App\Http\Controllers\Api\Vote\LogController'); // 日志 Log
	    // $api->get('vote_users/{user_id}/logs', '\App\Http\Controllers\Api\Vote\LogController@index');

	    // $api->group([ // 项目 Project
	    // 	'prefix' => 'project',
	    // ], function ($api) {
	    // 	$api->get('cases/{flag}', '\App\Http\Controllers\Api\Project\CasesController@index');
	    // 	$api->resource('cases', '\App\Http\Controllers\Api\Project\CasesController'); // 案例 Case
		// });

		$api->group([ // 结构 Structure
	    	'prefix' => 'structure',
	  ], function ($api) {
			$api->get('category_items/{parent_id}', '\App\Http\Controllers\Api\Structure\CategoryItemController@index');
	    	$api->resource('category_items', '\App\Http\Controllers\Api\Structure\CategoryItemController'); // 分类 项
		});

		$api->group([ // 基础 basic
	    	'prefix' => 'basic',
	    ], function ($api) {
			$api->resource('states', '\App\Http\Controllers\Api\Basic\StateController'); // 国家
			$api->resource('languages', '\App\Http\Controllers\Api\Basic\LanguageController'); // 语言
			$api->resource('currencies', '\App\Http\Controllers\Api\Basic\CurrencyController'); // 货币
			// $api->resource('products', '\App\Http\Controllers\Api\Basic\ProductController'); // 產品
			// $api->resource('suppliers', '\App\Http\Controllers\Api\Basic\SupplierController'); // 供应商

			// $api->resource('purchases', '\App\Http\Controllers\Api\Basic\PurchaseController'); // 采购单
			// $api->resource('orders', '\App\Http\Controllers\Api\Basic\OrderController'); // 订单
			// $api->resource('costs', '\App\Http\Controllers\Api\Basic\CostController'); // 消费
			// $api->resource('fees', '\App\Http\Controllers\Api\Basic\FeeController'); // 费用
		});

		$api->group([ // 倉庫 warehouse
	    	'prefix' => 'warehouse',
	    ], function ($api) {
			$api->resource('warehouses', '\App\Http\Controllers\Api\Warehouse\WarehouseController'); // 倉庫
			$api->resource('areas', '\App\Http\Controllers\Api\Warehouse\AreaController'); // 倉庫分區
			$api->resource('locations', '\App\Http\Controllers\Api\Warehouse\LocationController'); // 倉庫庫位
			$api->resource('products', '\App\Http\Controllers\Api\Warehouse\ProductController'); // 產品
			$api->resource('suppliers', '\App\Http\Controllers\Api\Warehouse\SupplierController'); // 供应商
			$api->resource('purchases', '\App\Http\Controllers\Api\Warehouse\PurchaseController'); // 采购单
			$api->resource('orders', '\App\Http\Controllers\Api\Warehouse\OrderController'); // 订单
			$api->resource('costs', '\App\Http\Controllers\Api\Warehouse\CostController'); // 消费
			$api->resource('fees', '\App\Http\Controllers\Api\Warehouse\FeeController'); // 费用
		});
	});
// });

