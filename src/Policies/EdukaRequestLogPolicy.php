<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\EdukaRequestLog;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EdukaRequestLogPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, EdukaRequestLog $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, EdukaRequestLog $model)
    {
        return false;
    }

    public function delete(User $user, EdukaRequestLog $model)
    {
        return false;
    }

    public function restore(User $user, EdukaRequestLog $model)
    {
        return false;
    }

    public function forceDelete(User $user, EdukaRequestLog $model)
    {
        return false;
    }

    public function replicate(User $user, EdukaRequestLog $model)
    {
        return false;
    }
}
