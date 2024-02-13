<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\RequestLog;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestLogPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, RequestLog $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, RequestLog $model)
    {
        return false;
    }

    public function delete(User $user, RequestLog $model)
    {
        return false;
    }

    public function restore(User $user, RequestLog $model)
    {
        return false;
    }

    public function forceDelete(User $user, RequestLog $model)
    {
        return false;
    }

    public function replicate(User $user, RequestLog $model)
    {
        return false;
    }
}
