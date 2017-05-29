<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->resolving(function ($object, $app) {
        //         echo "當容器解析任何型別的物件時會被呼叫...";
        //     });

        //     $this->app->resolving(HelpSpot\API::class, function ($api, $app) {
        //         echo "當容器解析「HelpSpot\API」型別的物件時會被呼叫...";
        //     });
    }


}
