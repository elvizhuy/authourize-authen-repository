<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class GroupPolicy
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
    public function view(User $user, Group $group): bool
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
        //     $check = isRole($roleArr, 'groups', 'add');
        //     return $check;
        // }
        // return false;
    }

    /**
     * Determine whether the User can update the model.
     */
    public function update(User $user, Group $group): bool
    {
        return $user->id == $group->user_id;
    }

    /**
     * Determine whether the User can delete the model.
     */
    public function delete(User $user, Group $group): bool
    {
        return $user->id == $group->user_id;
    }

    public function permission(User $user, Group $group): bool
    {
        return ($user->id == $group->user_id || $group->user_id == $user->user_id);
    }
    /**
     * Determine whether the User can restore the model.
     */
    public function restore(User $user, Group $group): bool
    {
        //
    }

    /**
     * Determine whether the User can permanently delete the model.
     */
    public function forceDelete(User $user, Group $group): bool
    {
        //
    }
}
