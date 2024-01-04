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
        set_default($user, 'uuid', (string) Str::uuid());

        $validationRules = [
            'name' => ['nullable', 'string'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'string'],
            'course_id_as_admin' => ['nullable', 'exists:courses,id'],
            'remember_token' => ['nullable', 'string'],
        ];

        $this->validate($user, $validationRules);
    }
}
