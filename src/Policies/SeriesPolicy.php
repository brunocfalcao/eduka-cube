<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Series;
use Eduka\Cube\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeriesPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Series $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Series $model)
    {
        return true;
    }

    public function delete(Student $student, Series $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Series $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Series $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Series $model)
    {
        return false;
    }
}
