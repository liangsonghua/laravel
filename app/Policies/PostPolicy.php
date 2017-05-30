<?php

namespace App\Policies;

use App\Repositories\UsersRepository;
// use App\Repositories\PostRepository;
use App\Policies\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can show the view.
     */
    public function show(UsersRepository $user, Post $post)
    {
        return true;
    }

    /**
     * Determine whether the user can create posts.
     */
    public function create(UsersRepository $user,Post $post)
    {
        return $user->role==='root';
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(UsersRepository $user, Post $post)
    {
        return $user->role==='root';
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(UsersRepository $user, Post $post)
    {
        return $user->role==='root';
    }
}
