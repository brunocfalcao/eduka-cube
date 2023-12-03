<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\User;
use Eduka\Cube\Models\VideoCompleted;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoCompletedPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, VideoCompleted $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, VideoCompleted $model)
    {
        return true;
    }

    public function delete(User $user, VideoCompleted $model)
    {
        return true;
    }

    public function restore(User $user, VideoCompleted $model)
    {
        return true;
    }

    public function forceDelete(User $user, VideoCompleted $model)
    {
        return true;
    }
}
