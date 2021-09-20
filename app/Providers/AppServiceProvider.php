<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use Ellaisys\Cognito\AwsCognitoClient;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Illuminate\Support\Arr;

use App\Managers\OrdersProviderManager;
use App\Contracts\OrdersProviderContract;
use App\Clients\AwsClient;

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
        $this->app->singleton(AwsClient::class, function (Application $app) {
            $aws_config = [
                'region'      => config('cognito.region'),
                'version'     => config('cognito.version')
            ];

            //Set AWS Credentials
            $credentials = config('cognito.credentials');
            if (! empty($credentials['key']) && ! empty($credentials['secret'])) {
                $aws_config['credentials'] = Arr::only($credentials, ['key', 'secret', 'token']);
            } //End if

            return new AwsClient(
                new CognitoIdentityProviderClient($aws_config),
                config('cognito.app_client_id'),
                config('cognito.app_client_secret'),
                config('cognito.user_pool_id')
            );
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
