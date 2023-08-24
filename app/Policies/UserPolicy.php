<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
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
    public function view(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the User can create models.
     */
    public function create(User $user): bool
    {
        // $roleJson = $User->group->permissions;
        // if (!empty($roleJson)) {
        //     $roleArr = json_decode($roleJson, true);
        //     $check = isRole($roleArr, 'users', 'add');
        //     return $check;
        // }
        // return false;
    }

    /**
     * Determine whether the User can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id == $model->user_id;

    }

    /**
     * Determine whether the User can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->id == $model->user_id;

    }

    /**
     * Determine whether the User can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the User can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return true;
    }
}
