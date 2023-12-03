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
            'old_id' => ['nullable', 'integer', 'min:0', 'max:4294967295'],
            'name' => ['nullable', 'string', 'min:1', 'max:255'],
            'email' => ['required', 'string', 'min:1', 'max:255'],
            'password' => ['nullable', 'string', 'min:1', 'max:255'],
            'remember_token' => ['nullable', 'string', 'min:1', 'max:100'],
            'receives_notifications' => ['required', 'boolean'],
            'uuid' => ['required', 'string', 'min:1', 'max:36']
        ]);
    }
}
