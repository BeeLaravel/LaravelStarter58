## Laravel Queue

### 命令
	queue
		work 启动
			--queue[=QUEUE]      队列名称
				php artisan queue:work --queue=high,default 有优先级的
			--daemon             守护模式
			--once               一次运行
			--stop-when-empty    队列空即停止
			--delay[=DELAY]      失败队列 0[default]
			--force              强制运行 无论是否在运维模式
			--memory[=MEMORY]    内存限制 megabytes 128[default]
			--sleep[=SLEEP]      无工作休眠时间 3[default]
			--timeout[=TIMEOUT]  子进程运行时间 60[default]
			--tries[=TRIES]      失败后重试次数 0[default]
		restart 重启
		listen # 监听

		failed 失败队列列表
		flush 失败队列清空
		forget [5] 失败队列删除
		retry [all|5] 失败队列重试

		table 队列待执行表
		failed-table 队列失败表

	make:job ProcessPodcast

### 队列分发
	Job::dispatch();
	Job::dispatch()->onQueue('emails');

	$this->app->bindMethod(\App\Jobs\ProcessPodcast::class.'@handle', function ($job, $app) {
	    return $job->handle($app->make(AudioProcessor::class));
	});