<?php
namespace App\Http\Controllers\Admin;

use App\Jobs\ProcessPodcast;

class Controller extends \App\Http\Controllers\Controller {
    public function __construct() {
    	// $this->middleware('auth:admin');
    }

    public function store(Request $request) {
        // ProcessPodcast::dispatchNow($podcast) // 不排队
        // ProcessPodcast::dispatch($podcast) // 排队
            // ->onConnection('sqs') // 连接
            // ->onQueue('processing') // 队列
            // ->delay(now()->addMinutes(10)) // 延时分发
		// ProcessPodcast::withChain([ // 链式分发
		//     new OptimizePodcast,
		//     new ReleasePodcast
		// ])->dispatch()
		// ->allOnConnection('redis') // 连接
		// ->allOnQueue('podcasts') // 队列

    	// ;

  //   	$podcast = App\Podcast::find(1);

		// dispatch(function () use ($podcast) {
		//     $podcast->publish();
		// });
		// dispatch((new Job)->onQueue('high'));
    }
}
