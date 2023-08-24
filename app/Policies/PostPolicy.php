<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the User can view any models.
     */


    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the User can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the User can create models.
     */
    public function create(User $user): bool
    {
        // $roleJson = $User->group->permissions;
        // if (!empty($roleJson)) {
        //     $roleArr = json_decode($roleJson, true);
        //     $check = isRole($roleArr, 'posts', 'add');
        //     return $check;
        // }
        // return false;
    }

    /**
     * Determine whether the User can update the model.
     */
    public function update(User $user, Post $post): bool
    {
       return $user->id == $post->user_id;
    }

    /**
     * Determine whether the User can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the User can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the User can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
}
