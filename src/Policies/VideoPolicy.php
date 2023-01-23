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

    public function view(User $user, Video $video)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Video $video)
    {
        return true;
    }

    public function delete(User $user, Video $video)
    {
        return true;
    }

    public function restore(User $user, Video $video)
    {
        return true;
    }

    public function forceDelete(User $user, Video $video)
    {
        return true;
    }
}
