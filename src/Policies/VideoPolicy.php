<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Student;
use Eduka\Cube\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Video $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Video $model)
    {
        return true;
    }

    public function delete(Student $student, Video $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Video $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Video $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Video $model)
    {
        return false;
    }

    public function attachAnyUser(Student $student, Video $model)
    {
        return false;
    }
}
