<?php

namespace App\Policies;

use App\Sample;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class SamplePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any samples.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the sample.
     *
     * @param  \App\User  $user
     * @param  \App\Sample  $sample
     * @return mixed
     */
    public function edit(User $user, Sample $sample)
    {
        return (string)Auth::user()->id === $sample->user_id;
    }

    /**
     * Determine whether the user can create samples.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Sample $sample)
    {
        return (string)Auth::user()->id === $sample->user_id;
    }

    /**
     * Determine whether the user can update the sample.
     *
     * @param  \App\User  $user
     * @param  \App\Sample  $sample
     * @return mixed
     */
    public function update(User $user, Sample $sample)
    {
        return (string)Auth::user()->id === $sample->user_id;
    }

    /**
     * Determine whether the user can delete the sample.
     *
     * @param  \App\User  $user
     * @param  \App\Sample  $sample
     * @return mixed
     */
    public function delete(User $user, Sample $sample)
    {
        return (string)Auth::user()->id === $sample->user_id;
    }

    /**
     * Determine whether the user can restore the sample.
     *
     * @param  \App\User  $user
     * @param  \App\Sample  $sample
     * @return mixed
     */
    public function restore(User $user, Sample $sample)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the sample.
     *
     * @param  \App\User  $user
     * @param  \App\Sample  $sample
     * @return mixed
     */
    public function forceDelete(User $user, Sample $sample)
    {
        //
    }
}
