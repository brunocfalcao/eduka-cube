<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Student;
use Eduka\Cube\Models\Subscriber;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriberPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Subscriber $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return true;
    }

    public function update(Student $student, Subscriber $model)
    {
        return true;
    }

    public function delete(Student $student, Subscriber $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Subscriber $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Subscriber $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Subscriber $model)
    {
        return false;
    }
}
