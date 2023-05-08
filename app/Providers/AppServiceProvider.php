<?php

namespace App\Providers;

use App\Lib\DbSessionStorage;
use App\Lib\Handlers\AppUninstalled;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Shopify\Context;
use Shopify\ApiVersion;
use Shopify\Webhooks\Registry;
use Shopify\Webhooks\Topics;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws \Shopify\Exception\MissingArgumentException
     */
    public function boot()
    {
       /* Context::initialize(
            Config::get('shopify.api_key'),
            Config::get('shopify.api_secret'),
            Config::get('shopify.scopes'),
            str_replace('https://', '', Config::get('shopify.host')),
            new DbSessionStorage(),
            ApiVersion::LATEST
        ); */
        Context::initialize(
            "0ed7632b923496aa0c99a70cb4cd20a2",
            "4904d7a085a211936337fe27808e6835",
            "write_products,write_draft_orders,write_customers",
            str_replace('https://', '', "https://laravel-test-app.herokuapp.com/"),
            new DbSessionStorage(),
            ApiVersion::LATEST
        );
        URL::forceScheme('https');

        Registry::addHandler(Topics::APP_UNINSTALLED, new AppUninstalled());
    }
}
