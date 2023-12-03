<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Series;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeriesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Series $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Series $model)
    {
        return true;
    }

    public function delete(User $user, Series $model)
    {
        return true;
    }

    public function restore(User $user, Series $model)
    {
        return true;
    }

    public function forceDelete(User $user, Series $model)
    {
        return true;
    }
}
