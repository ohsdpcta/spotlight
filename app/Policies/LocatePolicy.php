<?php

namespace App\Policies;

use App\Locate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class locatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any locates.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the locate.
     *
     * @param  \App\User  $user
     * @param  \App\Locate  $locate
     * @return mixed
     */
    public function edit(User $user, Locate $locate)
    {
        return (string)Auth::user()->id === $locate->user_id;
    }

    /**
     * Determine whether the user can create locates.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the locate.
     *
     * @param  \App\User  $user
     * @param  \App\Locate  $locate
     * @return mixed
     */
    public function update(User $user, Locate $locate)
    {
        return (string)Auth::user()->id === $locate->user_id;
    }

    /**
     * Determine whether the user can delete the locate.
     *
     * @param  \App\User  $user
     * @param  \App\Locate  $locate
     * @return mixed
     */
    public function delete(User $user, Locate $locate)
    {
        return (string)Auth::user()->id === $locate->user_id;
    }

    /**
     * Determine whether the user can restore the locate.
     *
     * @param  \App\User  $user
     * @param  \App\Locate  $locate
     * @return mixed
     */
    public function restore(User $user, Locate $locate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the locate.
     *
     * @param  \App\User  $user
     * @param  \App\Locate  $locate
     * @return mixed
     */
    public function forceDelete(User $user, Locate $locate)
    {
        //
    }
}