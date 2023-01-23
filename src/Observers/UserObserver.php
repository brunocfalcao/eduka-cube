<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function created(User $user)
    {
        //
    }

    public function updated(User $user)
    {
        //
    }

    public function saving(User $user)
    {
        if (blank($user->uuid)) {
            $user->uuid = (string) Str::uuid();
        }
    }

    public function deleted(User $user)
    {
        //
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        //
    }
}
