<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Course $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Course $model)
    {
        return true;
    }

    public function delete(User $user, Course $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(User $user, Course $model)
    {
        return true;
    }

    public function forceDelete(User $user, Course $model)
    {
        return $model->trashed();
    }

    public function replicate(User $user, Course $model)
    {
        return false;
    }
}
