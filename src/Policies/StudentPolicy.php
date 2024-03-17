<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Student $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Student $model)
    {
        return true && ! via_resource();
    }

    public function delete(Student $student, Student $model)
    {
        return $model->canBeDeleted() && ! via_resource();
    }

    public function restore(Student $student, Student $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Student $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Student $model)
    {
        return false;
    }

    public function attachAnyVideo(Student $student, Student $model)
    {
        return false;
    }

    public function attachAnyVariant(Student $student, Student $model)
    {
        return false;
    }

    public function attachAnyOrder(Student $student, Student $model)
    {
        info('verifying from user policy');

        return false;
    }

    public function attachAnyCourse(Student $student, Student $model)
    {
        return false;
    }
}
