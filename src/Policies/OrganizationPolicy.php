<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Organization;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Organization $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Organization $model)
    {
        return true;
    }

    public function delete(User $user, Organization $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(User $user, Organization $model)
    {
        return $model->trashed();
    }

    public function forceDelete(User $user, Organization $model)
    {
        return $model->trashed();
    }

    public function replicate(User $user, Organization $model)
    {
        return false;
    }
}
