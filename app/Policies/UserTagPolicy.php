<?php

namespace App\Policies;

use App\User;
use App\UserTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserTagPolicy
{
    use HandlesAuthorization;

    //---------------↓↓↓↓作ったやつ↓↓↓↓---------------------------------
    public function edit(User $user, UserTag $usertag)
    {
        return (string)Auth::user()->id === $usertag->user_id and (string)Auth::user()->role === "パフォーマー";
    }

    public function add(User $user, UserTag $usertag)
    {
        return (string)Auth::user()->id === $usertag->user_id and (string)Auth::user()->role === "パフォーマー";
    }

    public function delete(User $user, UserTag $usertag)
    {
        return (string)Auth::user()->id === $usertag->user_id and (string)Auth::user()->role === "パフォーマー";
    }

    //----------------↑↑↑作ったやつ↑↑↑--------------------------------------

    /**
     * Determine whether the user can view any user tags.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the user tag.
     *
     * @param  \App\User  $user
     * @param  \App\UserTag  $userTag
     * @return mixed
     */
    public function view(User $user, UserTag $userTag)
    {
        //
    }

    /**
     * Determine whether the user can create user tags.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user tag.
     *
     * @param  \App\User  $user
     * @param  \App\UserTag  $userTag
     * @return mixed
     */
    public function update(User $user, UserTag $userTag)
    {
        //
    }

    /**
     * Determine whether the user can restore the user tag.
     *
     * @param  \App\User  $user
     * @param  \App\UserTag  $userTag
     * @return mixed
     */
    public function restore(User $user, UserTag $userTag)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user tag.
     *
     * @param  \App\User  $user
     * @param  \App\UserTag  $userTag
     * @return mixed
     */
    public function forceDelete(User $user, UserTag $userTag)
    {
        //
    }
}
