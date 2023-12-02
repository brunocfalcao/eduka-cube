<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\VideoCompleted;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoCompletedPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, VideoCompleted $videoCompleted)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, VideoCompleted $videoCompleted)
    {
        return true;
    }

    public function delete(User $user, VideoCompleted $videoCompleted)
    {
        return true;
    }

    public function restore(User $user, VideoCompleted $videoCompleted)
    {
        return true;
    }

    public function forceDelete(User $user, VideoCompleted $videoCompleted)
    {
        return true;
    }
}
