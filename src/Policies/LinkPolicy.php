<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Link;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Link $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Link $model)
    {
        return true;
    }

    public function delete(User $user, Link $model)
    {
        return true;
    }

    public function restore(User $user, Link $model)
    {
        return true;
    }

    public function forceDelete(User $user, Link $model)
    {
        return true;
    }
}
