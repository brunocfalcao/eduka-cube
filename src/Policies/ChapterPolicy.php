<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChapterPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Chapter $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Chapter $model)
    {
        return true;
    }

    public function delete(User $user, Chapter $model)
    {
        return true;
    }

    public function restore(User $user, Chapter $model)
    {
        return true;
    }

    public function forceDelete(User $user, Chapter $model)
    {
        return true;
    }
}
