<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    use CanValidateObserverAttributes;

    public function saving(User $user)
    {
        if (blank($user->uuid)) {
            $user->uuid = (string) Str::uuid();
        }

        $this->validate($user, [
            'name' => 'required',
            'email' => 'required|email',
            'uuid' => 'required',
        ]);
    }
}
