<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\User;
use Eduka\Cube\Models\VideoStorage;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoStoragePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, VideoStorage $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, VideoStorage $model)
    {
        return true;
    }

    public function delete(User $user, VideoStorage $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(User $user, VideoStorage $model)
    {
        return true;
    }

    public function forceDelete(User $user, VideoStorage $model)
    {
        return $model->trashed();
    }

    public function replicate(User $user, VideoStorage $model)
    {
        return false;
    }
}
