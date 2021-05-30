<?php

namespace App\Policies;

use App\Models\Building;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BuildingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Building  $building
     * @return mixed
     */
    public function view(User $user, Building $building)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Building  $building
     * @return mixed
     */
    public function update(User $user, Building $building)
    {
        return $user->id === $building->user_id || $user->role_id === 1
            ? Response::allow()
            : Response::deny('ليس لديك إذن لتنفيذ هذا الإجراء');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Building  $building
     * @return mixed
     */
    public function delete(User $user, Building $building)
    {
        return $user->id === $building->user_id || $user->role_id === 1
            ? Response::allow()
            : Response::deny('ليس لديك إذن لتنفيذ هذا الإجراء');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Building  $building
     * @return mixed
     */
    public function restore(User $user, Building $building)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Building  $building
     * @return mixed
     */
    public function forceDelete(User $user, Building $building)
    {
        //
    }
}
