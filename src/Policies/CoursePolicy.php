<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Course $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Course $model)
    {
        return true;
    }

    public function delete(Student $student, Course $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Course $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Course $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Course $model)
    {
        return false;
    }

    public function attachAnyUser(Student $student, Course $model)
    {
        return false;
    }
}
