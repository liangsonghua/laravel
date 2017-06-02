<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use App\Repositories\FocusRepository;
class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        // Broadcast::channel('App.User.*', function ($user, $userId) {
        //     return (int) $user->id === (int) $userId;
        // });

        
        Broadcast::channel('douban.{channel_id}', function ($user, $channel_id) {
            return true;
            // var_dump($user->id === FocusRepository::findOrFail($channel_id)->user_id);
            // return $user->id === FocusRepository::findOrFail($channel_id)->user_id;
        });
    }
}
