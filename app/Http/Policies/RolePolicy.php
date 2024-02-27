<?php

namespace App\Http\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user has the specified role.
     *
     * @param  \App\Models\User  $user
     * @param  string  $roleName
     * @return bool
     */
    public function hasRole(User $user, string $roleName)
    {
        return $user->role->name === $roleName;
    }
}
