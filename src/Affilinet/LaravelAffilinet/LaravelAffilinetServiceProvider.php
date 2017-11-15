<?php
namespace Affilinet\LaravelAffilinet;
use Affilinet\ProductData\AffilinetClient;
use Illuminate\Support\ServiceProvider;


class LaravelAffilinetServiceProvider extends ServiceProvider

{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Bootstrap classes for packages.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__.'/../../../config/affilinet.php');
        if (class_exists('Illuminate\Foundation\Application', false)) {
            $this->publishes([$source => config_path('affilinet.php')]);
        }
        $this->mergeConfigFrom($source, 'affilinet');
        $this->app['\Affilinet\ProductData\AffilinetClient'] = function ($app) {
            return $app['affilinet'];
        };
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $this->app->singleton('affilinet', function () use ($app) {
            $config = [
                'publisher_id' => $app['config']['affilinet']['publisher_id'],
                'product_webservice_password' => $app['config']['affilinet']['product_webservice_password'],
                'log' => $app['log'],
            ];
            return new AffilinetClient($config);
        });

    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('affilinet');
    }
}