<?php

namespace App\Providers;
use App\Repositories\PostRepository;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Repositories\UsersRepository;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *应用的策略映射.
     * @var array
     */
    protected $policies = [
        PostRepository::class =>PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        //  Gate::define('create',function($user) {
        //         return $user->role==='root';
        // });

        //   Gate::define('store',function($user,Post $post) {
        //          return true;
        // });
        //   Gate::define('edit',function($user) {
        //        return true;
        // });
        //   Gate::define('update',function($user,Post $post) {
        //         return true;
        // });
        //    Gate::define('destory',function($user) {
        //          return true;
        // });
    }
}
