<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\User;

class UserObserver
{
    /**
     * Handle the User "saved" event.
     *
     * @param  \Eduka\Models\User  $applicationLog
     * @return void
     */
    public function saved(User $user)
    {
        //
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \Eduka\Models\User  $applicationLog
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \Eduka\Models\User  $applicationLog
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \Eduka\Models\User  $applicationLog
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \Eduka\Models\User  $applicationLog
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \Eduka\Models\User  $applicationLog
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
