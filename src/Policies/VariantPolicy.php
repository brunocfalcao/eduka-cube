<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\User;
use Eduka\Cube\Models\Variant;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariantPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Variant $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Variant $model)
    {
        return true;
    }

    public function delete(User $user, Variant $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(User $user, Variant $model)
    {
        return $model->trashed();
    }

    public function forceDelete(User $user, Variant $model)
    {
        return $model->trashed();
    }

    public function replicate(User $user, Variant $model)
    {
        return false;
    }

    public function attachAnyUser(User $user, Variant $model)
    {
        return false;
    }
}
