<?php

namespace App\Policies;

use App\Follower;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class FollowerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any followers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the follower.
     *
     * @param  \App\User  $user
     * @param  \App\Follower  $follower
     * @return mixed
     */
    public function edit(User $user, Follower $follower)
    {
        return (string)Auth::user()->id !== $follower->target_id;
    }

    /**
     * Determine whether the user can create followers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the follower.
     *
     * @param  \App\User  $user
     * @param  \App\Follower  $follower
     * @return mixed
     */
    public function update(User $user, Follower $follower)
    {
        //
    }

    /**
     * Determine whether the user can delete the follower.
     *
     * @param  \App\User  $user
     * @param  \App\Follower  $follower
     * @return mixed
     */
    public function delete(User $user, Follower $follower)
    {
        //
    }

    /**
     * Determine whether the user can restore the follower.
     *
     * @param  \App\User  $user
     * @param  \App\Follower  $follower
     * @return mixed
     */
    public function restore(User $user, Follower $follower)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the follower.
     *
     * @param  \App\User  $user
     * @param  \App\Follower  $follower
     * @return mixed
     */
    public function forceDelete(User $user, Follower $follower)
    {
        //
    }
}
