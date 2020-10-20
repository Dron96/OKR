<?php

namespace App\Policies;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param  \App\Models\Goal  $goal
     * @return mixed
     */
    public function updateOrDeleteSendForCheckCreateKeyResult(User $user, Goal $goal)
    {
        return $user->role === 'manager' and
            $goal->author === $user->id;
    }

    public function ApproveReject(User $user, Goal $goal)
    {
        return $user->role === 'leader';
    }
}
