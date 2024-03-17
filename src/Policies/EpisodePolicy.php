<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Episode;
use Eduka\Cube\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class EpisodePolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Episode $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Episode $model)
    {
        return true;
    }

    public function delete(Student $student, Episode $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Episode $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Episode $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Episode $model)
    {
        return false;
    }

    public function attachAnyUser(Student $student, Episode $model)
    {
        return false;
    }
}
