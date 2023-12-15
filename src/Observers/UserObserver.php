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
            'old_id' => ['nullable', 'integer'],
            'name' => ['nullable', 'string'],
            'email' => ['required', 'string'],
            'password' => ['nullable', 'string'],
            'remember_token' => ['nullable', 'string'],
            'uuid' => ['required', 'string'],
        ]);
    }
}
