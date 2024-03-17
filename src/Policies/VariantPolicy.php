<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Student;
use Eduka\Cube\Models\Variant;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariantPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Variant $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Variant $model)
    {
        return true;
    }

    public function delete(Student $student, Variant $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Variant $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Variant $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Variant $model)
    {
        return false;
    }

    public function attachAnyUser(Student $student, Variant $model)
    {
        return false;
    }
}
