<?php

namespace App\Policies;

use App\Paypay;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaypayPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any paypays.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the paypay.
     *
     * @param  \App\User  $user
     * @param  \App\Paypay  $paypay
     * @return mixed
     */
    public function edit(User $user, Paypay $paypay)
    {
        return (string)Auth::user()->id === $paypay->user_id and (string)Auth::user()->role === "パフォーマー";
    }

    /**
     * Determine whether the user can create paypays.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the paypay.
     *
     * @param  \App\User  $user
     * @param  \App\Paypay  $paypay
     * @return mixed
     */
    public function update(User $user, Paypay $paypay)
    {
        //
    }

    /**
     * Determine whether the user can delete the paypay.
     *
     * @param  \App\User  $user
     * @param  \App\Paypay  $paypay
     * @return mixed
     */
    public function delete(User $user, Paypay $paypay)
    {
        //
    }

    /**
     * Determine whether the user can restore the paypay.
     *
     * @param  \App\User  $user
     * @param  \App\Paypay  $paypay
     * @return mixed
     */
    public function restore(User $user, Paypay $paypay)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the paypay.
     *
     * @param  \App\User  $user
     * @param  \App\Paypay  $paypay
     * @return mixed
     */
    public function forceDelete(User $user, Paypay $paypay)
    {
        //
    }
}
