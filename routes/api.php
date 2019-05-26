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

		// $api->group([ // 结构 Structure
	    // 	'prefix' => 'structure',
	    // ], function ($api) {
	    // 	$api->get('category_items/{parent_id}', '\App\Http\Controllers\Api\Structure\CategoryItemController@index');
	    // 	$api->resource('category_items', '\App\Http\Controllers\Api\Structure\CategoryItemController'); // 分类 项
		// });

		$api->group([ // 结构 Structure
	    	'prefix' => 'structure',
	    ], function ($api) {
	    	$api->resource('category_items', '\App\Http\Controllers\Api\Structure\CategoryItemController'); // 分类 项
		});
	});
// });

