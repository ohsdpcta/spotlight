<?php

namespace App\Policies;

use App\SmallProfile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class SmallProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any small profiles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the small profile.
     *
     * @param  \App\User  $user
     * @param  \App\SmallProfile  $smallProfile
     * @return mixed
     */
    public function edit(User $user, SmallProfile $smallProfile)
    {
        return (string)Auth::user()->id === $smallProfile->user_id;
    }

    /**
     * Determine whether the user can create small profiles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the small profile.
     *
     * @param  \App\User  $user
     * @param  \App\SmallProfile  $smallProfile
     * @return mixed
     */
    public function update(User $user, SmallProfile $smallProfile)
    {
        return (string)Auth::user()->id === $smallProfile->user_id;
    }

    /**
     * Determine whether the user can delete the small profile.
     *
     * @param  \App\User  $user
     * @param  \App\SmallProfile  $smallProfile
     * @return mixed
     */
    public function delete(User $user, SmallProfile $smallProfile)
    {
        return (string)Auth::user()->id === $smallProfile->user_id;
    }

    /**
     * Determine whether the user can restore the small profile.
     *
     * @param  \App\User  $user
     * @param  \App\SmallProfile  $smallProfile
     * @return mixed
     */
    public function restore(User $user, SmallProfile $smallProfile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the small profile.
     *
     * @param  \App\User  $user
     * @param  \App\SmallProfile  $smallProfile
     * @return mixed
     */
    public function forceDelete(User $user, SmallProfile $smallProfile)
    {
        //
    }
}
