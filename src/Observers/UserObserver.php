<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        $user->validate();
    }
}
