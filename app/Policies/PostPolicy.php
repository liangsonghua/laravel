<?php

namespace App\Policies;

use App\Repositories\UsersRepository;
use App\Repositories\PostRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     */
    public function view(UsersRepository $user, PostRepository $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     */
    public function create(UsersRepository $user,PostRepository $post)
    {
        return $user->role==='root';
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(UsersRepository $user, PostRepository $post)
    {
        return $user->role==='root';
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(UsersRepository $user, PostRepository $post)
    {
        return $user->role==='root';
    }
}
