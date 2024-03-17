<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Link;
use Eduka\Cube\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Link $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Link $model)
    {
        return true;
    }

    public function delete(Student $student, Link $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Link $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Link $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Link $model)
    {
        return false;
    }
}
