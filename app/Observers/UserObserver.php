<?php
namespace App\Observers;

use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;
class UserObserver
{
    // creating, created, updating, updated, saving, saved,
     // deleting, deleted, restoring, restored.
    public function updating(UsersRepository $user) 
    {
        //防止伪造表单
         $attributes = $user->getOriginal();
         return $attributes['role']===Auth::user()->role;
    }

    public function saving(UsersRepository $user) 
    {

    }

    public function saved(UsersRepository $user) 
    {
          
    }

    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(UsersRepository $user)
    {
        //
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(UsersRepository $user)
    {
        //
    }
}
?>