<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Order;
use Eduka\Cube\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, Order $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        // Orders are created only via the payment gateway.
        return false;
    }

    public function update(Student $student, Order $model)
    {
        return true;
    }

    public function delete(Student $student, Order $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(Student $student, Order $model)
    {
        return $model->trashed();
    }

    public function forceDelete(Student $student, Order $model)
    {
        return $model->trashed();
    }

    public function replicate(Student $student, Order $model)
    {
        return false;
    }

    public function attachAnyUser(Student $student, Order $model)
    {
        return false;
    }
}
