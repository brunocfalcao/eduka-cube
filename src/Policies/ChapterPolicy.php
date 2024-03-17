<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChapterPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Chapter $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Chapter $model)
    {
        return true;
    }

    public function delete(Student $student, Chapter $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Chapter $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Chapter $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Chapter $model)
    {
        return false;
    }
}
