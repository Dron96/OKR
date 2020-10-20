<?php

namespace App\Policies;

use App\Models\Goal;
use App\Models\KeyResult;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeyResultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\KeyResult  $keyResult
     * @return mixed
     */
    public function updateOrDeleteOrAddPerformers(User $user, KeyResult $keyResult)
    {
        return $user->role === 'manager' and
            $keyResult->goal->author === $user->id;
    }
}
