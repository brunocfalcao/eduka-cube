<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Backend;
use Eduka\Cube\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class BackendPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Backend $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Backend $model)
    {
        return true;
    }

    public function delete(Student $student, Backend $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Backend $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Backend $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Backend $model)
    {
        return false;
    }
}
