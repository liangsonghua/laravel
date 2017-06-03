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

        // require base_path('routes/channels.php');
        Broadcast::channel('douban.{channel_id}', function ($user, $channel_id) {
             echo "auth ok!";
             return true;
            return $user->id === FocusRepository::findOrFail($channel_id)->user_id;
        });
    }
}
