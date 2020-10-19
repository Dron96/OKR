<?php

namespace App\Policies;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoalPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role === 'manager';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Goal  $goal
     * @return mixed
     */
    public function updateOrDeleteSendForCheck(User $user, Goal $goal)
    {
        return $user->role === 'manager' and
            $goal->author === $user->id;
    }

    public function ApproveReject(User $user, Goal $goal)
    {
        return $user->role === 'leader';
    }
}
