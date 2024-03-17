<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\RequestLog;
use Eduka\Cube\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestLogPolicy
{
    use HandlesAuthorization;

    public function viewAny(Student $student)
    {
        return true;
    }

    public function view(Student $student, RequestLog $model)
    {
        return true;
    }

    public function create(Student $student)
    {
        return false;
    }

    public function update(Student $student, RequestLog $model)
    {
        return false;
    }

    public function delete(Student $student, RequestLog $model)
    {
        return false;
    }

    public function restore(Student $student, RequestLog $model)
    {
        return false;
    }

    public function forceDelete(Student $student, RequestLog $model)
    {
        return false;
    }

    public function replicate(Student $student, RequestLog $model)
    {
        return false;
    }
}
