<?php

namespace App\Policies;

use App\User;
use App\Trade;
use Illuminate\Auth\Access\HandlesAuthorization;

class TradePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the trade.
     *
     * @param  \App\User  $user
     * @param  \App\Trade  $trade
     * @return mixed
     */
    public function update(User $user, Trade $trade)
    {
        return $user->id === $trade->requestedBook->user->id;
    }

    /**
     * Determine whether the user can delete the trade.
     *
     * @param  \App\User  $user
     * @param  \App\Trade  $trade
     * @return mixed
     */
    public function delete(User $user, Trade $trade)
    {
        return $user->id === $trade->offeredBook->user->id;
    }
}
