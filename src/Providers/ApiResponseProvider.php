<?php

namespace Csosc\ApiResponse\Providers;

use Csosc\ApiResponse\Http\Middleware\ApiAccept;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ApiResponseProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('apiAccept', ApiAccept::class);

    }
}
