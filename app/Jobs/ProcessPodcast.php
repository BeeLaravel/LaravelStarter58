<?php
namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels; // 序列化模型

use App\Podcast;
use App\AudioProcessor;
use App\Jobs\Middleware\RateLimited;

use Illuminate\Support\Facades\Redis;

class ProcessPodcast implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $connection = 'sqs'; // 连接
    public $tries = 5;
    public $timeout = 120;
    public $deleteWhenMissingModels = true; // 自动删除缺失的任务

    protected $podcast;

    public function __construct(Podcast $podcast) {
        $this->podcast = $podcast;
    }

    public function middleware() {
        return [new RateLimited];
    }

    public function retryUntil() {
        return now()->addSeconds(5);
    }

    public function handle(AudioProcessor $processor) {
        Redis::throttle('key')
            ->block(0)->allow(1)->every(5)
            ->then(function () {
                info('Lock obtained...');
            }, function () {
                return $this->release(5);
            });
    }
    public function failed(Exception $exception) {
    }
}
// Queue::looping(function () {
//     while (DB::transactionLevel() > 0) {
//         DB::rollBack();
//     }
// });
