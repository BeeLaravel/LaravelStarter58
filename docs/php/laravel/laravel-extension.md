## Laravel 扩展包开发

### Laravel 包自动发现
	"extra": {
	    "laravel": {
	        "providers": [
	            "Barryvdh\\Debugbar\\ServiceProvider" // 服务提供者
	        ],
	        "aliases": {
	            "Debugbar": "Barryvdh\\Debugbar\\Facade" // 门面
	        }
	    }
	},

	"extra": {
	    "laravel": {
	        "dont-discover": [
	            "barryvdh/laravel-debugbar" // 禁用单个
	            "*" // 禁用所有
	        ]
	    }
	},

php artisan make:provider RiskServiceProvider
config/app.php 文件中的 providers 
	public $bindings = [
        ServerProvider::class => DigitalOceanServerProvider::class,
    ];
    public $singletons = [
        DowntimeNotifier::class => PingdomDowntimeNotifier::class,
    ];