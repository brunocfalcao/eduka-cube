<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Tag;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Tag $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Tag $model)
    {
        return true;
    }

    public function delete(User $user, Tag $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(User $user, Tag $model)
    {
        return $model->trashed();
    }

    public function forceDelete(User $user, Tag $model)
    {
        return $model->trashed();
    }

    public function replicate(User $user, Tag $model)
    {
        return false;
    }
}
