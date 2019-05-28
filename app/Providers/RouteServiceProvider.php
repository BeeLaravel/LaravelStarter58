<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
    protected $namespace = 'App\Http\Controllers';

    public function boot() {
        parent::boot();
    }

    public function map() {
        $this->mapApiRoutes();
        $this->mapWebRoutes();

        // applications
        $this->mapShopRoutes();
        $this->mapWarehouseRoutes();

        // apis
        $this->mapSoapRoutes();
        $this->mapRestRoutes();

        // others
        $this->mapPackageRoutes();
        $this->mapBeesoftRoutes();
        $this->mapToolRoutes();
        $this->mapTestRoutes();
    }

    protected function mapApiRoutes() {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
    protected function mapWebRoutes() {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    // applications
    protected function mapShopRoutes() {
        Route::prefix('shop')
            ->middleware('web')
            ->namespace($this->namespace.'\Shop')
            ->group(base_path('routes/shop.php'));
    }
    protected function mapWarehouseRoutes() {
        Route::prefix('warehouse')
            ->middleware('web')
            ->namespace($this->namespace.'\Warehouse')
            ->group(base_path('routes/warehouse.php'));
    }

    // apis
    protected function mapSoapRoutes() {
        Route::prefix('soap')
            ->middleware('web')
            ->namespace($this->namespace.'\Soap')
            ->group(base_path('routes/soap.php'));
    }
    protected function mapRestRoutes() {
        Route::prefix('rest')
            ->middleware('web')
            ->namespace($this->namespace.'\Rest')
            ->group(base_path('routes/rest.php'));
    }

    // others
    protected function mapPackageRoutes() {
        Route::prefix('package')
            ->middleware('web')
            ->namespace($this->namespace.'\Package')
            ->group(base_path('routes/package.php'));
    }
    protected function mapBeesoftRoutes() {
        Route::prefix('beesoft')
            ->middleware('web')
            ->namespace($this->namespace.'\Beesoft')
            ->group(base_path('routes/beesoft.php'));
    }
    protected function mapTestRoutes() {
        Route::prefix('test')
            ->middleware('web')
            ->namespace($this->namespace.'\Test')
            ->group(base_path('routes/test.php'));
    }
    protected function mapToolRoutes() {
        Route::prefix('tool')
            ->middleware('web')
            ->namespace($this->namespace.'\Tool')
            ->group(base_path('routes/tool.php'));
    }
}
