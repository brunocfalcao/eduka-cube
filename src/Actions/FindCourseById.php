<?php

namespace Eduka\Cube\Actions;

use Eduka\Cube\Models\Course;

class FindCourseById
{
    public static function find(int $id): Course
    {
        return Course::find($id);
    }
}
