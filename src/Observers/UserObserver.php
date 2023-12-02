<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function saving(User $user)
    {
        if (blank($user->uuid)) {
            $user->uuid = (string) Str::uuid();
        }
    }
}
