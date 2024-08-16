<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    /**
     * Determine whether the user can view any roles.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('voir role');
    }

    /**
     * Determine whether the user can view the role.
     */
    //    public function view(User $user, Role $role): bool
    //    {
    //        return $user->hasPermissionTo('voir role');
    //    }

    /**
     * Determine whether the user can create roles.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('créer role');
    }

    /**
     * Determine whether the user can update the role.
     */
    public function update(User $user, Role $role): bool
    {
        return $role->users->contains($user->id) && $user->hasPermissionTo('modifier role');
    }

    /**
     * Determine whether the user can delete the role.
     */
    public function delete(User $user, Role $role): bool
    {
        return $role->users->contains($user->id) && $user->hasPermissionTo('supprimer role');
    }
}
