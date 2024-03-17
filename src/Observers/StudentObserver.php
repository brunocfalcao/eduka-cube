<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Student;

class StudentObserver
{
    public function saving(Student $student)
    {
        $student->validate();
    }
}
