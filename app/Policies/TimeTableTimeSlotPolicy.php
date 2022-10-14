<?php

namespace App\Policies;

use App\Models\TimetableTimeSlot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimetableTimeSlotPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->can('read timetabletimeslot')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User              $user
     * @param \App\Models\TimetableTimeSlot $timetableTimeSlot
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TimetableTimeSlot $timetableTimeSlot)
    {
        if ($user->can('read timetableTimeSlot') && $user->school_id == $timetableTimeSlot->timetable->MyClass->school->id) {
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
    public function create(User $user)
    {
        if ($user->can('create timetabletimeslot')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User              $user
     * @param \App\Models\TimetableTimeSlot $timetableTimeSlot
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TimetableTimeSlot $timetableTimeSlot)
    {
        if ($user->can('update timetabletimeslot') && $user->school_id == $timetableTimeSlot->timetable->MyClass->school->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User              $user
     * @param \App\Models\TimetableTimeSlot $timetableTimeSlot
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TimetableTimeSlot $timetableTimeSlot)
    {
        if ($user->can('delete timetabletimeslot') && $user->school_id == $timetableTimeSlot->timetable->MyClass->school->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User              $user
     * @param \App\Models\TimetableTimeSlot $timetableTimeSlot
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TimetableTimeSlot $timetableTimeSlot)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User              $user
     * @param \App\Models\TimetableTimeSlot $timetableTimeSlot
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TimetableTimeSlot $timetableTimeSlot)
    {
        //
    }
}
