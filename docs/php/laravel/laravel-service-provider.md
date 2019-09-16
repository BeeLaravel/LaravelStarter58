## ServiceProvider 服务提供者

### composer.json 中指定 服务提供者
	"extra": {
	    "laravel": {
	        "providers": [
	            "Barryvdh\\Debugbar\\ServiceProvider" // 服务提供者
	        ]
	    }
	},

### 基本信息
	config/app.php providers # 系统 providers

	/bootstrap/cache/packages.php # 软件包服务提供者
		'aimeos/aimeos-laravel' => 
		  array (
		    'providers' => 
		    array (
		      0 => 'Aimeos\\Shop\\ShopServiceProvider',
		    ),
		  ),
	/bootstrap/cache/services.php providers # 所有服务提供者

	/app/Providers # 应用 ServiceProvider 存放目录

	Illuminate\Support\ServiceProvider # 基服务提供者

	php artisan make:provider RiskServiceProvider # 控制台创建 ServiceProvider

### 绑定

	public $bindings = [
        ServerProvider::class => DigitalOceanServerProvider::class,
    ];
    public $singletons = [
        DowntimeNotifier::class => PingdomDowntimeNotifier::class,
    ];

### 原理
	接收到 HTTP 请求时会去执行「服务提供者的 register（注册）」方法 将各个服务「绑定」到容器内
	之后，到了实际处理请求阶段，依据使用情况按需加载所需服务

	boot 注册事件监听器、引入路由文件、注册过滤器