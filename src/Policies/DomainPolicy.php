<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Domain;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DomainPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Domain $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Domain $model)
    {
        return true;
    }

    public function delete(User $user, Domain $model)
    {
        return true;
    }

    public function restore(User $user, Domain $model)
    {
        return true;
    }

    public function forceDelete(User $user, Domain $model)
    {
        return true;
    }
}
