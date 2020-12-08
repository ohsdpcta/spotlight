<?php

namespace App\Policies;

use App\Goods;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoodsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any goods.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the goods.
     *
     * @param  \App\User  $user
     * @param  \App\Goods  $goods
     * @return mixed
     */
    public function edit(User $user, Goods $goods)
    {
        return (string)Auth::user()->id === $goods->user_id;
    }

    /**
     * Determine whether the user can create goods.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the goods.
     *
     * @param  \App\User  $user
     * @param  \App\Goods  $goods
     * @return mixed
     */
    public function update(User $user, Goods $goods)
    {
        //
    }

    /**
     * Determine whether the user can delete the goods.
     *
     * @param  \App\User  $user
     * @param  \App\Goods  $goods
     * @return mixed
     */
    public function delete(User $user, Goods $goods)
    {
        //
    }

    /**
     * Determine whether the user can restore the goods.
     *
     * @param  \App\User  $user
     * @param  \App\Goods  $goods
     * @return mixed
     */
    public function restore(User $user, Goods $goods)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the goods.
     *
     * @param  \App\User  $user
     * @param  \App\Goods  $goods
     * @return mixed
     */
    public function forceDelete(User $user, Goods $goods)
    {
        //
    }
}
