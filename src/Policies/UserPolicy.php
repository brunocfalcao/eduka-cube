<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, User $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, User $model)
    {
        return true && ! via_resource();
    }

    public function delete(User $user, User $model)
    {
        return $model->canBeDeleted() && ! via_resource();
    }

    public function restore(User $user, User $model)
    {
        return $model->trashed();
    }

    public function forceDelete(User $user, User $model)
    {
        return $model->trashed();
    }

    public function replicate(User $user, User $model)
    {
        return false;
    }

    public function attachAnyVideo(User $user, User $model)
    {
        return false;
    }

    public function attachAnyVariant(User $user, User $model)
    {
        return false;
    }

    public function attachAnyOrder(User $user, User $model)
    {
        info('verifying from user policy');

        return false;
    }

    public function attachAnyCourse(User $user, User $model)
    {
        return false;
    }
}
