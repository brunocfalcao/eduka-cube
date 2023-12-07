<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\User;
use Eduka\Cube\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Video $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Video $model)
    {
        return true;
    }

    public function delete(User $user, Video $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(User $user, Video $model)
    {
        return $model->trashed();
    }

    public function forceDelete(User $user, Video $model)
    {
        return $model->trashed();
    }

    public function replicate(User $user, Video $model)
    {
        return false;
    }
}
