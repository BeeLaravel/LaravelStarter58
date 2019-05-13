<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        // applications
        $this->mapShopRoutes();
        $this->mapWarehouseRoutes();

        // others
        $this->mapPackageRoutes();
        $this->mapBeesoftRoutes();
        $this->mapToolRoutes();
        $this->mapTestRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
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

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
