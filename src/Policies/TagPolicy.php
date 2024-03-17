<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Student;
use Eduka\Cube\Models\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Tag $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Tag $model)
    {
        return true;
    }

    public function delete(Student $student, Tag $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Tag $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Tag $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Tag $model)
    {
        return false;
    }
}
