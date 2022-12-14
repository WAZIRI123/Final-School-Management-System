<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user,$role)
    {
        if ($user->can("read $role")) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Subject $subject
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Subject $subject, $role)
    {
        if ($user->can("read $role") && $user->school_id == $subject->school_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user,$role)
    {
        if ($user->can("create $role")) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Subject $subject
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Subject $subject, $role)
    {
        if ($user->can("update $role") && $user->school_id == $subject->school_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Subject $subject
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Subject $subject, $role)
    {
        if ($user->can("delete $role") && $user->school_id == $subject->school_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Subject $subject
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Subject $subject, $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Subject $subject
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Subject $subject, $role)
    {
        //
    }
}
