<?php
namespace App\Jobs\Middleware;

use Illuminate\Support\Facades\Redis;

class RateLimited {
    public function handle($job, $next) {
        Redis::throttle('key')
            ->block(0)->allow(1)->every(5)
            ->then(function () use ($job, $next) {
                $next($job);
            }, function () use ($job) {
                $job->release(5);
            });
        Redis::funnel('key')
            ->limit(1)
            ->then(function () use ($job, $next) {
                $next($job);
            }, function () use ($job) {
                $job->release(5);
            });
    }
}
