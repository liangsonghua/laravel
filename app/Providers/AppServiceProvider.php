<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Observers\UserObserver;
use App\Repositories\UsersRepository;
use App\Repositories\ProjectRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('key', 'value');
        UsersRepository::observe(UserObserver::class);
         // $this->app->resolving(function ($object, $app) {
        //         echo "當容器解析任何型別的物件時會被呼叫...";
        //     });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       if (env('APP_DEBUG')) {
           $this->app->register('VIACreative\SudoSu\ServiceProvider');
           $this->app->register('Vinkla\Pusher\PusherServiceProvider');
       }
    
    }


}
