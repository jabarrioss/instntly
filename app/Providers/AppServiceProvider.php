<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Managers\OrdersProviderManager;
use App\Contracts\OrdersProviderContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(OrdersProviderContract::class, function ($app) {
            if ($app->request->adapter !== null) {
                $manager = new OrdersProviderManager();
                return $manager->resolve($app->request->adapter);
            } else {
                throw new \RuntimeException('Orders provider adapter not found');
            }
        });
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
