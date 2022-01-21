<?php

namespace Csosc\ApiResponse;

use Csosc\ApiResponse\Http\Middleware\ApiAccept;
use Csosc\ApiResponse\Http\Middleware\ApiSecret;
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
        $router->aliasMiddleware('apiSecret', ApiSecret::class);

        if (app()->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/apiresponse.php' => config_path('apiresponse.php'),
            ], 'api-response-config');
        }

    }
}
